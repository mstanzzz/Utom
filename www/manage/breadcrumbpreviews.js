$(document).ready(function() {

    // breadcrumb adding / removing / previewing changes script
    var totalbcs = $("#breadcrumb_container").find(".breadcrumb_edit_group").length;
    totalbcs = Number(totalbcs) + 1;

    function getOrderByName(name) {
        var nameend = name.length - 1;
        var newname = name.slice(nameend, name.length);
        return newname;
    }

    function getNewName(name, order) {
        var nameend = name.length - 1;
        var newname = name.slice(0, nameend) + order;
        return newname;
    }

    function sortbcs(parent, childSelector, keySelector) {
        var items = parent.children(childSelector).sort(function(a, b) {
            var vA = $(a).attr(keySelector);
            var vB = $(b).attr(keySelector);
            return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
        });
        parent.append(items);
    }

    function applyChangeListeners() {

        // change breadcrumb previews when the title fields are updated
        $(".bc_title").change(function() {
            var previewbc = $(this).attr("name");
            $(".edit_breadcrumbs .well").find("#bc_" + getOrderByName(previewbc)).find("a").text($(this).val());

        });

        // change breadcrumb order when orders are updated
        $(".bc_order").change(function() {
            var neworderval = $(this).val();
            var itemchanged = $(this).attr("name");
            var totalorderfields = $("#breadcrumb_container").find(".bc_order").length;
            $("#breadcrumb_container").find(".bc_order").each(function() {
                var currentitem = $(this).attr("name");
                if ($(this).val() == neworderval && currentitem != itemchanged) {
                    $(this).val(Number(totalorderfields) + 1)
                }
                $(".edit_breadcrumbs .well").find("#bc_" + getOrderByName(currentitem)).attr("data-bcorder", $(this).val());
            });
            sortbcs($('.sortablebcs'), "span.bc", "data-bcorder");
        });

        // add event listener to remove breadcrumbs that have not been saved
        $("a.confirm.unsaved").click(function(e) {
            e.preventDefault();
            var previewbc = $(this).closest(".breadcrumb_edit_group").find(".bc_order").attr("name");
            $(".edit_breadcrumbs .well").find("#bc_" + getOrderByName(previewbc)).remove();
            $(this).closest(".breadcrumb_edit_group").remove();
            totalbcs = totalbcs - 1;
        });

        //reapply multiselect jquery ui widget to select elements
        $(".unsaved_bc").find("select[multiple]").multiselect({
            selectedList: 4
        }).multiselectfilter();
        $(".unsaved_bc").find("select").not("[multiple]").multiselect({
            multiple: false,
            selectedList: 1
        }).multiselectfilter();

    }
    $(".add_breadcrumb").click(function(e) {
        e.preventDefault();

        totalbcs = Number(totalbcs) + 1;

        //copy the existing bc markup and apply new unique names and order values to form fields...
        var new_edit_fields = $("#breadcrumb_container").find(".breadcrumb_edit_group").last().clone();

        $(new_edit_fields).find(":input").each(function() {
            var name = $(this).attr("name");

            if (!$(this).is("button")) {
                if (name.indexOf("order") != -1) {
                    $(this).val(totalbcs);
                    $(this).attr("value", totalbcs);
                }
                $(this).attr("name", getNewName(name, totalbcs));
            }
        });


        //make the new delete buttons simply delete the unsaved bc
        $(new_edit_fields).find("a.confirm").addClass("unsaved");


        //remove multiselect jquery ui widget to select elements
        $(new_edit_fields).find(".ui-multiselect").remove();


        //add new breadcrumb to preview...
        var bc = $(".edit_breadcrumbs .well .bc").last().clone();
        var oldid = $(bc).attr("id");
        $(bc).attr("id", getNewName(oldid, totalbcs));
        $(bc).find("a").attr("id", getNewName(oldid, totalbcs));
        $(bc).attr("data-bcorder", totalbcs);
        $(".edit_breadcrumbs .well .bc").last().after(bc);

        //add the new section to the page for editing.
        $(new_edit_fields).addClass("unsaved_bc").appendTo("#breadcrumb_container");

        applyChangeListeners();

    });
    applyChangeListeners();
});