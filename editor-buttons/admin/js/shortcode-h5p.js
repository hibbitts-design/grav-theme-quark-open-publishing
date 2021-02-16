(function($){
    $(function(){
        $('body').on('grav-editor-ready', function() {
            var Instance = Grav.default.Forms.Fields.EditorField.Instance;
            Instance.addButton({
              'shortcodes-h5p': {
                identifier: 'shortcodes-h5p',
                title: 'H5P Content',
                label: '<strong>H5P</strong>',
                modes: ['gfm', 'markdown'],
                action: function(_ref) {
                    var codemirror = _ref.codemirror, button = _ref.button;
                    button.on('click.editor.shortcodes-h5p', function() {
                      Instance.buttonStrategies.replaceSelections({ token: '$1', template: '[h5p]$1[/h5p]', codemirror: codemirror});
                      codemirror.setCursor(codemirror.getCursor().line,codemirror.getCursor().ch-6);
                    });
                }
              }
            });
        });
    });
})(jQuery);
