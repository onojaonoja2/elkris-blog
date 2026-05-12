import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';

const initializeEditor = () => {
    const editorElement = document.getElementById('tiptap-editor');
    if (!editorElement) return false;

    const editor = new Editor({
        element: editorElement,
        extensions: [
            StarterKit.configure({
                heading: { levels: [2, 3] },
            }),
            Image.configure({
                inline: false,
                allowBase64: true,
            }),
            Link.configure({
                openOnClick: false,
                HTMLAttributes: {
                    class: 'text-secondary underline hover:text-secondary-fixed-dim transition-colors',
                },
            }),
            Placeholder.configure({
                placeholder: 'Start writing your story...',
            }),
        ],
        editorProps: {
            attributes: {
                class: 'prose prose-lg max-w-none focus:outline-none min-h-[500px] px-0 font-article text-article-body',
            },
        },
        onUpdate: ({ editor }) => {
            const hiddenInput = document.getElementById('body-content');
            if (hiddenInput) {
                hiddenInput.value = editor.getHTML();
            }
        },
    });

    const toolbarButtons = {
        'bold': () => editor.chain().focus().toggleBold().run(),
        'italic': () => editor.chain().focus().toggleItalic().run(),
        'heading-2': () => editor.chain().focus().toggleHeading({ level: 2 }).run(),
        'heading-3': () => editor.chain().focus().toggleHeading({ level: 3 }).run(),
        'bullet-list': () => editor.chain().focus().toggleBulletList().run(),
        'ordered-list': () => editor.chain().focus().toggleOrderedList().run(),
        'blockquote': () => editor.chain().focus().toggleBlockquote().run(),
        'code-block': () => editor.chain().focus().toggleCodeBlock().run(),
        'horizontal-rule': () => editor.chain().focus().setHorizontalRule().run(),
        'undo': () => editor.chain().focus().undo().run(),
        'redo': () => editor.chain().focus().redo().run(),
    };

    Object.entries(toolbarButtons).forEach(([id, action]) => {
        const btn = document.getElementById('editor-' + id);
        if (btn) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                action();
                updateActiveStates();
            });
        }
    });

    const updateActiveStates = () => {
        const marks = {
            'bold': editor.isActive('bold'),
            'italic': editor.isActive('italic'),
            'heading-2': editor.isActive('heading', { level: 2 }),
            'heading-3': editor.isActive('heading', { level: 3 }),
            'bullet-list': editor.isActive('bulletList'),
            'ordered-list': editor.isActive('orderedList'),
            'blockquote': editor.isActive('blockquote'),
            'code-block': editor.isActive('codeBlock'),
        };

        Object.entries(marks).forEach(([id, active]) => {
            const btn = document.getElementById('editor-' + id);
            if (btn) {
                btn.classList.toggle('bg-primary-container/10', active);
                btn.classList.toggle('text-primary-container', active);
                btn.classList.toggle('text-outline', !active);
            }
        });
    };

    editor.on('selectionUpdate', () => updateActiveStates());

    return editor;
};

const initFeaturedImageUpload = () => {
    const uploadBtn = document.getElementById('upload-featured-image');
    const fileInput = document.getElementById('featured-image-input');
    const preview = document.getElementById('featured-image-preview');

    if (!uploadBtn || !fileInput) return;

    uploadBtn.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files?.[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (event) => {
            if (preview) {
                preview.src = event.target?.result;
                preview.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(file);
    });
};

const initSlugGenerator = () => {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (!titleInput || !slugInput) return;

    titleInput.addEventListener('input', () => {
        const slug = titleInput.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        slugInput.value = slug;
    });
};

const initAutoSave = () => {
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('body-content');

    if (!titleInput || !contentInput) return;

    const saveDraft = () => {
        const draft = {
            title: titleInput.value,
            content: contentInput.value || '',
            savedAt: new Date().toISOString(),
        };
        try {
            localStorage.setItem('elkris-draft', JSON.stringify(draft));
        } catch (e) {}
    };

    setInterval(saveDraft, 30000);

    titleInput.addEventListener('input', saveDraft);
};

const confirmPublish = () => {
    const publishBtn = document.getElementById('publish-btn');
    if (!publishBtn) return;

    publishBtn.addEventListener('click', (e) => {
        if (!confirm('Are you sure you want to publish this post?')) {
            e.preventDefault();
        }
    });
};

document.addEventListener('DOMContentLoaded', () => {
    initializeEditor();
    initFeaturedImageUpload();
    initSlugGenerator();
    initAutoSave();
    confirmPublish();
});
