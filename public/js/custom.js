//// Custom JavaScript 
// Should be moved to resources/assets/js/custom.js [and minified] 
console.log("Logged"); // is not logged 
let _drumId; 
$(".bookmark").on("click", event => { 
    console.log("Clicked"); 
    event.preventDefault(); 
    _drumId = event.target.parentNode.dataset; 
    $.ajax({
        method: 'POST', 
        url: urlBookmark, 
        data: {isBookmark: "true", drumId: 1, _token: token}
    }).done( () => { 
        console.log("Attempted"); 
    }).fail( error => { 
        console.log(error); 
    }); 
}); 

/// Sort  

