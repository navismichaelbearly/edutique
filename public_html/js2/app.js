var App = {
    elements: {
        tags: null
    },
    constants: {
        errors: {
            MISSING_FIELDS: {
                heading: "Required Fields Missing",
                message: "Please make sure you specify a Note and select a Tag"
            },
            INSUFFICIENT_CHARS: {
                heading: "Insufficient Characters",
                message: "Please select atleast 10 characters"
            }
        }
    },
    variables: {
        messageDisplayed: false
    },
    helpers: {
        resetControls: function() {
            App.elements.tags.dropdown("clear").dropdown("set text", "Select Tag");
            $x("textarea").val("");
        },
        showBackdrop: function(isShown) {
            $x(".backdrop")[isShown ? "show" : "hide"]();
        },
        showError: function(error) {
            if (!App.variables.messageDisplayed) {
                App.variables.messageDisplayed = true;

                $x("#error_message").find(".header").html(error.heading);
                $x("#error_message").find(".message").html(error.message);

                $x("#error_message").transition("fly down");

                window.setTimeout(
                    function() {
                        App.variables.messageDisplayed = false;

                        $x("#error_message").transition("fly up");
                    },
                    5000
                );
            }
        }
    },
    handlers: {
        fillNotes: function(selection) {
            $x("textarea").val(selection).trigger("change");
        },
        captureNotes: function(text) {
            $x.Annotator.api.captureActiveAnnotationNotes(text.value);
        },
        applyTag: function(tagName) {
            $x.Annotator.api.tagActiveAnnotation(tagName);
        },
        cancelAnnotation: function() {
            App.helpers.resetControls();
            App.helpers.showBackdrop(false);

            $x.Annotator.api.destroyActiveAnnotation();
        },
        saveAnnotation: function() {
            var result = $x.Annotator.api.saveActiveAnnotation();

            if (!result.isSaved) {
                App.helpers.showError(App.constants.errors[result.errorCode]);
            } else {
                App.helpers.resetControls();
                App.helpers.showBackdrop(false);
            }
        },
        renderSavedAnnotations: function(annotations) {
            var html = $x.templates("#annotations_tmpl").render({
                annotations: annotations.map((item) => {
                    if (item.type === "Requirement") {
                        item.color = "orange";
                    } else if (item.type === "Backlog") {
                        item.color = "teal";
                    } else {
                        item.color = "blue";
                    }

                    return item;
                })
            });

            $x("#annotations_list").html(html);
        },
        deleteAnnotation: function(annotationId) {
            var remainingAnnotations =
                $x.Annotator.api.deleteAnnotation(annotationId);

            App.handlers.renderSavedAnnotations(remainingAnnotations);
        }
    },
    init: function() {
        $x(".example").annotator({
            popoverContents: "#annotate_settings",
            minimumCharacters: 10,
            makeTextEditable: true,
            onannotationsaved: function() {
                App.handlers.renderSavedAnnotations(this.annotations);
            },
            onselectioncomplete: function() {
                App.handlers.fillNotes(this.outerText);
                App.helpers.showBackdrop(true);
            },
            onerror: function() {
                App.helpers.showError(App.constants.errors[this]);
            }
        });

        App.elements.tags = $x(".ui.dropdown")
            .dropdown({
                clearable: true,
                direction: "upward",
                onChange: function(value, text, $choice) {
                    if ($choice)
                        App.handlers.applyTag($choice.attr("name"));
                }
            });
    }
};

App.init();
