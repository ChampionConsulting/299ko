
document.addEventListener("DOMContentLoaded", function() {

    if (document.querySelector('.gallery .categories button')) {

        document.querySelectorAll('.gallery .categories button').forEach(function(item, index) {
            item.addEventListener('click', function(){
                var rel = this.getAttribute('rel');

                document.querySelectorAll('.gallery #list li').forEach(function(item, index) {
                    item.style.display = 'none';
                });

                document.querySelectorAll('.gallery #list li.'+rel).forEach(function(item, index) {
                    fadeIn(item, 'block');
                });

            });
        });

    }

});