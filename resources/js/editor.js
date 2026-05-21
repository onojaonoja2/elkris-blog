import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';

const initializeEditor = () => {
    const editorElement = document.getElementById('tiptap-editor');
    if (!editorElement) return false;

    // Inject list styles for ProseMirror editor
    if (!document.getElementById('pm-list-styles')) {
        const style = document.createElement('style');
        style.id = 'pm-list-styles';
        style.textContent = `
            #tiptap-editor ul, #tiptap-editor ol,
            .ProseMirror ul, .ProseMirror ol {
                padding-left: 1.5rem !important;
                margin-bottom: 1.5rem !important;
                list-style-position: inside !important;
            }
            #tiptap-editor ul, .ProseMirror ul { list-style-type: disc !important; }
            #tiptap-editor ol, .ProseMirror ol { list-style-type: decimal !important; }
            #tiptap-editor li, .ProseMirror li {
                display: list-item !important;
                margin-bottom: 0.25rem !important;
                list-style-position: inside !important;
            }
            #tiptap-editor li::before, .ProseMirror li::before {
                display: none !important;
                content: none !important;
            }
            #tiptap-editor ul ul, .ProseMirror ul ul { list-style-type: circle !important; }
            #tiptap-editor ol ol, .ProseMirror ol ol { list-style-type: lower-alpha !important; }
        `;
        document.head.appendChild(style);
    }

    const initialContent = editorElement.dataset.initialBody || '';

    const editor = new Editor({
        element: editorElement,
        content: initialContent,
        extensions: [
            StarterKit.configure({
                heading: { levels: [2, 3] },
                bulletList: {
                    keepMarks: true,
                    keepAttributes: false,
                },
                orderedList: {
                    keepMarks: true,
                    keepAttributes: false,
                },
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
        onCreate: ({ editor }) => {
            const hiddenInput = document.getElementById('body-content');
            if (hiddenInput) {
                hiddenInput.value = editor.getHTML();
            }
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
    const previewContainer = document.getElementById('featured-image-preview-container');
    const removeBtn = document.getElementById('remove-featured-image');
    const removeInput = document.getElementById('remove-featured-image-input');

    if (!uploadBtn || !fileInput) return;

    const handleUploadClick = (e) => {
        e.preventDefault();
        e.stopPropagation();
        fileInput.click();
    };

    uploadBtn.addEventListener('mousedown', handleUploadClick);
    uploadBtn.addEventListener('touchstart', handleUploadClick);

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files?.[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (event) => {
            if (preview) {
                preview.src = event.target?.result;
                preview.classList.remove('hidden');
            }
            if (previewContainer) {
                previewContainer.classList.remove('hidden');
            }
            if (removeInput) {
                removeInput.value = '0';
            }
        };
        reader.readAsDataURL(file);
    });

    if (removeBtn) {
        removeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            fileInput.value = '';
            if (preview) {
                preview.src = '';
                preview.classList.add('hidden');
            }
            if (previewContainer) {
                previewContainer.classList.add('hidden');
            }
            if (removeInput) {
                removeInput.value = '1';
            }
        });
    }
};

const initVideoUpload = () => {
    const uploadBtn = document.getElementById('upload-video');
    const fileInput = document.getElementById('video-input');
    const preview = document.getElementById('video-preview');
    const previewContainer = document.getElementById('video-preview-container');
    const removeBtn = document.getElementById('remove-video');
    const removeInput = document.getElementById('remove-video-input');

    if (!uploadBtn || !fileInput) return;

    const handleUploadClick = (e) => {
        e.preventDefault();
        e.stopPropagation();
        fileInput.click();
    };

    uploadBtn.addEventListener('mousedown', handleUploadClick);
    uploadBtn.addEventListener('touchstart', handleUploadClick);

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files?.[0];
        if (!file) return;

        const url = URL.createObjectURL(file);
        if (preview) {
            preview.src = url;
            preview.classList.remove('hidden');
        }
        if (previewContainer) {
            previewContainer.classList.remove('hidden');
        }
        if (removeInput) {
            removeInput.value = '0';
        }
    });

    if (removeBtn) {
        removeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            fileInput.value = '';
            if (preview) {
                preview.src = '';
                preview.classList.add('hidden');
            }
            if (previewContainer) {
                previewContainer.classList.add('hidden');
            }
            if (removeInput) {
                removeInput.value = '1';
            }
        });
    }
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
    initVideoUpload();
    initSlugGenerator();
    initAutoSave();
});
