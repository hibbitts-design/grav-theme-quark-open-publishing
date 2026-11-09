/* Editor button: wraps the selection in [term]...[/term]. Same file in Quark Open Publishing, Quark 2 Open Publishing
   and Helios Open Reader (assets/editor-term.js) – keep the copies the same - hibbittsdesign.org */
(function($){
    $(function(){
        $('body').on('grav-editor-ready', function() {
            var Instance = Grav.default.Forms.Fields.EditorField.Instance;
            Instance.addButton({
              'shortcodes-term': {
                identifier: 'shortcodes-term',
                title: 'Glossary Term',
                label: '<i class="fa fa-book"></i>',
                modes: ['gfm', 'markdown'],
                action: function(_ref) {
                    var codemirror = _ref.codemirror, button = _ref.button;
                    button.on('click.editor.shortcodes-term', function() {
                      Instance.buttonStrategies.replaceSelections({ token: '$1', template: '[term]$1[/term]', codemirror: codemirror});
                      codemirror.setCursor(codemirror.getCursor().line,codemirror.getCursor().ch-7);
                    });
                }
              }
            });
        });
    });
})(jQuery);
