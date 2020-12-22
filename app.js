$(".toggleForms").click(function() { 
            
    $("#signUpForm").toggle();
    $("#logInForm").toggle();
});

$(".hide").click(function() {

  $(".diary-info").toggle();
});
  
$('#diary').bind('input propertychange', function() {

  $.ajax({ method: "POST", url: "updatedatabase.php", data: { content: $("#diary").val() } });
});

var autoExpand = function (field) { 

  field.style.height = 'inherit';
  var computed = window.getComputedStyle(field);
  var height = field.scrollHeight;
  field.style.height = height + 'px';
};

document.addEventListener('input', function (event) { 

  if (event.target.tagName.toLowerCase() !== 'textarea') return;
  autoExpand(event.target);
}, false);
