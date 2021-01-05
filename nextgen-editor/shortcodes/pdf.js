window.nextgenEditor.addHook('hookInit', () => {
    window.nextgenEditor.addButtonGroup('quark-open-publishing', {
        label: 'Quark Open Publishing',
    });
});

window.nextgenEditor.addShortcode('pdf', {
    type: 'block',
    plugin: 'quark-open-publishing',
    title: 'PDF',
    button: {
        label: 'PDF',
        group: 'quark-open-publishing',
    },
    attributes: {
        url: {
            type: String,
            innerHTML: true,
            title: 'URL',
            widget: 'input-text',
            default: '',
        },
    },
    titlebar({ attributes }) {
        return `URL: <strong>${attributes.url || '<em>No URL provided</em>'}</strong>`;
    },
    content({ attributes }) {
        return attributes.url

          ? `<div style="position:relative;padding-bottom:100%;height:0;padding-bottom:56.2493%;"><iframe src="https://docs.google.com/gview?url=${attributes.url}&embedded=true" frameborder="0" style="position:absolute;width:100%;height:100%;top:0;left:0;" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe></div>`
          : '<div style="margin:36px;text-align:center;">No URL provided</div>';
    },
    preserve: {
        block: [
            'iframe',
        ],
    },
});
