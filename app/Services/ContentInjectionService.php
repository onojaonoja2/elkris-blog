<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ContentInjectionService
{
    public function injectMedia(string $bodyContent, ?string $videoPath = null, string $videoPosition = 'middle', ?string $imagePath = null, string $imagePosition = 'middle', ?string $imageCaption = null): string
    {
        if (! $videoPath && ! $imagePath) {
            return $bodyContent;
        }

        $insertions = [];

        if ($videoPath && $videoPosition === 'middle') {
            $insertions[] = $this->createVideoHtml($videoPath);
        }

        if ($imagePath && $imagePosition === 'middle') {
            $insertions[] = $this->createImageHtml($imagePath, $imageCaption);
        }

        if (empty($insertions)) {
            return $bodyContent;
        }

        return $this->injectAtMiddle($bodyContent, $insertions);
    }

    private function injectAtMiddle(string $html, array $insertions): string
    {
        $insertionHtml = implode('', $insertions);

        $paragraphs = preg_split('/(<\/p>)/i', $html, -1, PREG_SPLIT_DELIM_CAPTURE);

        $paragraphCount = 0;
        foreach ($paragraphs as $part) {
            if (stripos($part, '</p>') !== false || (trim(strip_tags($part)) !== '' && ! str_starts_with(trim($part), '<'))) {
                $paragraphCount++;
            }
        }

        if ($paragraphCount === 0) {
            return $html.$insertionHtml;
        }

        $halfPoint = (int) ceil($paragraphCount / 2);
        $currentCount = 0;
        $insertPosition = -1;

        foreach ($paragraphs as $i => $part) {
            if (stripos($part, '</p>') !== false || (trim(strip_tags($part)) !== '' && ! str_starts_with(trim($part), '<'))) {
                $currentCount++;
            }
            if ($currentCount >= $halfPoint) {
                $insertPosition = $i + 1;
                break;
            }
        }

        if ($insertPosition === -1) {
            $insertPosition = count($paragraphs);
        }

        array_splice($paragraphs, $insertPosition, 0, [$insertionHtml]);

        return implode('', $paragraphs);
    }

    private function createVideoHtml(string $videoPath): string
    {
        $url = Storage::url($videoPath);

        return '<div class="my-8 rounded-xl overflow-hidden shadow-lg bg-black">'
            .'<video class="w-full" controls playsinline>'
            .'<source src="'.e($url).'" type="video/mp4">'
            .'Your browser does not support the video tag.'
            .'</video></div>';
    }

    private function createImageHtml(string $imagePath, ?string $caption = null): string
    {
        $url = Storage::url($imagePath);
        $alt = e($caption ?? '');

        $html = '<div class="my-8 rounded-xl overflow-hidden shadow-xl">'
            .'<img src="'.e($url).'" alt="'.$alt.'" class="w-full" />'
            .'</div>';

        if ($caption) {
            $html .= '<p class="text-caption text-outline mt-2 text-center">'.e($caption).'</p>';
        }

        return $html;
    }
}
