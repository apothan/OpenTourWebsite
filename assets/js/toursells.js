


jQuery(document).ready(function() {
    //Get the div that holds the collection of tags
    var collectionHolder = $('#sellbreak_list tbody');

    // setup an "add a tag" link
    var $addSellbreakLink = $('<td><a href="#" class="add_sellbreak_link">Add Prices</a></td>');
    var $newLinkTr = $('<tr></tr>').append($addSellbreakLink);

    // add a delete link to all of the existing tag form li elements
    collectionHolder.find('tr').each(function() {
        addTagFormDeleteLink($(this));
    });
        
    // add the "add a tag" anchor and li to the tags ul
    collectionHolder.append($newLinkTr);

    $addSellbreakLink.click( function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTagForm(collectionHolder, $newLinkTr);
    });
});

function addTagForm(collectionHolder, $newLinkTr) {
    // Get the data-prototype we explained earlier
    var prototype = collectionHolder.attr('data-prototype');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on the current collection's length.
    var newForm = prototype.replace(/__name__/g, collectionHolder.children().length);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<tr></tr>').append(newForm);
    $newLinkTr.before($newFormLi);

    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);
    // var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    //if (!isChrome)
    //	$('.datepicker').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
}

function addTagFormDeleteLink($tagFormTr) {
    var $removeFormA = $('<td><a href="#">delete these prices</a></td>');
    $tagFormTr.append($removeFormA);
    
    $removeFormA.click(function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormTr.remove();
    });
}