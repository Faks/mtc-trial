/**
 * Created by darknet on 2017.05.09..
 */
//Custom Modal button & accordions
$('#Confirm').on('shown.bs.modal', function () {
    $('#Confirm').focus()
});

//create article custom submit button
/*
$(document).ready(function(){
    var formId = $('form').attr('id');

    alert(formId);
});

*/
//Profile Tab issue solved should make it universal ....
$(document).ready(function()
{
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e)
    {
	    localStorage.setItem('activeTab', $(e.target).attr('href'));
	});

	var activeTab = localStorage.getItem('activeTab');

	if(activeTab)
	{
		$('#user').find('a[href="' + activeTab + '"]').tab('show');
	}

});



var url = window.location;
// Will only work if string in href matches with location
$('ul.nav a[href="'+ url +'"]').parent().addClass('active');

// Will also work for relative and absolute hrefs
$('ul.nav a').filter(function()
{
	return this.href == url;
}).parent().addClass('active');


$(function()
{
    /*Check if hash is empty to pass variable to js*/
    if (window.location.hash != '')
    {
        $('a[href="' + window.location.hash + '"]').click()
    }
    else
    {
        $('.navbar-nav a[href="' + document.location.hash + '"]').tab('show');
    }

    /*Fail Safe*/
    $('a[data-toggle="tab"]').on('click', function (e)
    {
        history.pushState(null, null, $(this).attr('href'));
    });
});


//Settings and User Settings
    $(".nav-pills").click(function()
    {
       if (document.location.hash === document.location.hash)
       {
           $('a[href="' + document.location.hash + '"]').tab('show');
       }
    });
//Settings and User Settings


//has to figure out to pass dynamic id.
$('#to-message').click(function() {

    $('a[href="#message-1"]').tab('show');
});


function submit()
{
    //Finds Form ID
    var formId = $('form').attr('id');
    //Pass Form ID to submit
    var form = document.getElementById(formId);

        form.submit();
}




var fixedTop = false;
var transparent = true;
var navbar_initialized = false;

$(document).ready(function(){
    window_width = $(window).width();

    // Init navigation toggle for small screens
    if(window_width <= 991){
        pd.initRightMenu();
    }

    //  Activate the tooltips
    $('[rel="tooltip"]').tooltip();

});

// activate collapse right menu when the windows is resized
$(window).resize(function(){
    if($(window).width() <= 991){
        pd.initRightMenu();
    }
});

pd = {
    misc:{
        navbar_menu_visible: 0
    },
    checkScrollForTransparentNavbar: debounce(function() {
        if($(document).scrollTop() > 381 ) {
            if(transparent) {
                transparent = false;
                $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                $('.navbar-title').removeClass('hidden');
            }
        } else {
            if( !transparent ) {
                transparent = true;
                $('.navbar-color-on-scroll').addClass('navbar-transparent');
                $('.navbar-title').addClass('hidden');
            }
        }
    }),
    initRightMenu: function(){
        if(!navbar_initialized){
            $off_canvas_sidebar = $('nav').find('.navbar-collapse').first().clone(true);

            $sidebar = $('.sidebar');
            sidebar_bg_color = $sidebar.data('background-color');
            sidebar_active_color = $sidebar.data('active-color');

            $logo = $sidebar.find('.logo').first();
            logo_content = $logo[0].outerHTML;

            ul_content = '';

            // set the bg color and active color from the default sidebar to the off canvas sidebar;
            $off_canvas_sidebar.attr('data-background-color',sidebar_bg_color);
            $off_canvas_sidebar.attr('data-active-color',sidebar_active_color);

            $off_canvas_sidebar.addClass('off-canvas-sidebar');

            //add the content from the regular header to the right menu
            $off_canvas_sidebar.children('ul').each(function(){
                content_buff = $(this).html();
                ul_content = ul_content + content_buff;
            });

            // add the content from the sidebar to the right menu
            content_buff = $sidebar.find('.nav').html();
            ul_content = ul_content + '<li class="divider"></li>'+ content_buff;

            ul_content = '<ul class="nav navbar-nav">' + ul_content + '</ul>';

            navbar_content = logo_content + ul_content;
            navbar_content = '<div class="sidebar-wrapper">' + navbar_content + '</div>';

            $off_canvas_sidebar.html(navbar_content);

            $('body').append($off_canvas_sidebar);

            $toggle = $('.navbar-toggle');

            $off_canvas_sidebar.find('a').removeClass('btn btn-round btn-default');
            $off_canvas_sidebar.find('button').removeClass('btn-round btn-fill btn-info btn-primary btn-success btn-danger btn-warning btn-neutral');
            $off_canvas_sidebar.find('button').addClass('btn-simple btn-block');

            $toggle.click(function (){
                if(pd.misc.navbar_menu_visible == 1) {
                    $('html').removeClass('nav-open');
                    pd.misc.navbar_menu_visible = 0;
                    $('#bodyClick').remove();
                    setTimeout(function(){
                        $toggle.removeClass('toggled');
                    }, 400);

                } else {
                    setTimeout(function(){
                        $toggle.addClass('toggled');
                    }, 430);

                    div = '<div id="bodyClick"></div>';
                    $(div).appendTo("body").click(function() {
                        $('html').removeClass('nav-open');
                        pd.misc.navbar_menu_visible = 0;
                        $('#bodyClick').remove();
                        setTimeout(function(){
                            $toggle.removeClass('toggled');
                        }, 400);
                    });

                    $('html').addClass('nav-open');
                    pd.misc.navbar_menu_visible = 1;

                }
            });
            navbar_initialized = true;
        }

    }
}

/*
 Returns a function, that, as long as it continues to be invoked, will not
 be triggered. The function will be called after it stops being called for
 N milliseconds. If `immediate` is passed, trigger the function on the
 leading edge, instead of the trailing.
 */

function debounce(func, wait, immediate)
{
    var timeout;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
};