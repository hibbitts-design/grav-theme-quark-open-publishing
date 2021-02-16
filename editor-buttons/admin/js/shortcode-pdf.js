(function($){
    $(function(){
        $('body').on('grav-editor-ready', function() {
            var Instance = Grav.default.Forms.Fields.EditorField.Instance;
            Instance.addButton({
              'shortcodes-pdf': {
                identifier: 'shortcodes-pdf',
                title: 'PDF File',
                label: '<i class="fa fa-file-pdf-o"></i>',
                modes: ['gfm', 'markdown'],
                action: function(_ref) {
                    var codemirror = _ref.codemirror, button = _ref.button;
                    button.on('click.editor.shortcodes-pdf', function() {
                      Instance.buttonStrategies.replaceSelections({ token: '$1', template: '[pdf]$1[/pdf]', codemirror: codemirror});
                      codemirror.setCursor(codemirror.getCursor().line,codemirror.getCursor().ch-6);
                    });
                }
              }
            });
        });
    });
})(jQuery);
