(function ($) {
    "use strict";
    var input = $('.validate-input .input100');
    $('.validate-form').on('submit',function(){
        var check = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
        return check;
    });
    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });
    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
})(jQuery);

async function fetchFerrys() {
    try {
        const response = await fetch('fetch_routes.php');
        const ferrys = await response.json();

        const grid = document.querySelector('.ferry-grid');
        const ferrySection = document.querySelector('.ferry-section'); 
        grid.innerHTML = ''; 

        if (ferrys.length === 0) {
            ferrySection.style.display = 'none';
            return;
        }
        ferrySection.style.display = 'block';
        const ferrysToDisplay = ferrys.slice(0, 40);
        ferrysToDisplay.forEach(ferry => {
            const card = document.createElement('div');
            card.classList.add('ferry-card');
            card.setAttribute('onclick', `navigateToDetails(${ferry.rid})`);

            card.innerHTML = `
                <img src="${ferry.image}" alt="${ferry.make} ${ferry.model}">
                <div class="cnt">
                    <h3>${ferry.name}</h3>
                    <p><span>Departure</span>: ${ferry.departure}, <span>Time</span> : ${ferry.dtime}</p>
                    <p><span>Departure</span>: ${ferry.destination}, <span>Time</span> : ${ferry.atime}</p>
                    <p class="price">$${ferry.price}</p>
                </div>
            `;

            grid.appendChild(card);
        });
    } catch (error) {
        console.error('Error fetching ferry data:', error);
    }
}

window.onload = fetchFerrys;
function navigateToDetails(ferryId) {
    window.location.href = `ferry-details.php?id=${ferryId}`;
}

window.addEventListener('scroll', reveal);
        function reveal(){
        var reveals = document.querySelectorAll('.reveal');
        for(var i = 0; i < reveals.length; i++){
            var windowheight = window.innerHeight;
            var revealtop = reveals[i].getBoundingClientRect().top;
            var revealpoint = 150;

        if(revealtop < windowheight - revealpoint){
            reveals[i].classList.add('active');
        } else {
            reveals[i].classList.remove('active');
        }
    }
}

