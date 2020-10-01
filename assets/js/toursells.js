jQuery(document).ready(function() {
    //Get the div that holds the collection of tags
    var collectionHolder = $('#sellbreak_list tbody');

    

    // add a delete link to all of the existing tag form li elements
    collectionHolder.find('tr').each(function() {
        addTagFormDeleteLink($(this));
    });
        

    
});

function addTagFormDeleteLink($tagFormTr) {
    var $removeFormA = $('<td><a href="#">delete</a></td>');
    $tagFormTr.append($removeFormA);
    
    $removeFormA.click(function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormTr.remove();
    });
}