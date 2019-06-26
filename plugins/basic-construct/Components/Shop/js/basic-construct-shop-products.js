
jQuery(document).ready(function($) {

  var lastScrollPosition = $('footer').scrollTop();
  var pageCount = 1;
  var page = 1;

/*  $(window).scroll(function() {

    if (page <= pageCount) {
      if($(document).scrollTop() > lastScrollPosition) {
        if($(window).scrollTop() + $(window).height() >= $(document).height() - $('footer').innerHeight()) {
          console.log('get next page');
          page++;
          products($('#bc-shop-category-id').val());
        }
      }
    }
  });
*/
  $('ol.breadcrumb').on('click', 'a', function(e) {
    e.preventDefault();
    return false;
  });

  $('.bc-shop-nav a.nav-link').on('click', function(e) {

    e.preventDefault();

    var $this = $(this);
    var $page = $('.bc-shop-products-page');
    var id = $this.attr('data-id');

    //page = 1;

    $('.bsnav span').removeClass('down');
    $this.find('span').toggleClass('down');

    //$('#bc-shop-category-id').val(id);

    breadcrumbs($this);
    //console.log($this.closest('li').children('ul').length);
    if ($this.closest('li').children('ul').length == 0) {
      $.when($page.fadeOut()).done(function() {
        $page.html();
        products(id);
      });

    }

    return false;

  });

  function products(category) {
    //console.log('/wp-json/products/' + category + '/?page=' + page);
    $.ajax({
      method: "get",
      url: '/wp-json/products/' + category + '/?page=' + page,
      success: function(response) {
        if (response.products && response.products[0]) {
          pageCount = response.products[0].pageCount;
        }
        var rv = '';
        if(response.products.length > 0) {;
          $.each(response.products, function(k, v) {

            //console.log(v);
            rv += '<div class="card-wrapper float-left">' +
            '<div class="card text-center">' +
              '<a href="/?post_type=product&p=' + v.id + '" title="">' +
                '<div class="card-header">' +
                  v.title +
                '</div>' +
                '<div class="card-image-wrap text-center">' +
                  '<img class="card-img-top" title="' + v.title + '" src="' + v.image + '">' +
                '</div><div class="card-body"><p class="card-text"></p></div>' +
                '<div class="card-footer"><button class="btn btn-primary">' + v.price + '</button></div>' +
              '</a></div></div>';
          });
        } else {
          rv = '<div class="text-center">No products in this category</div>';
        }
          $('.bc-shop-products-page').html(rv);
          $('.bc-shop-products-page').fadeIn('slow');

      },
      failure: function(response) {
        console.log(response);
      }
    });
  }

  function breadcrumbs(link) {
    var $ol = $('ol.breadcrumb')
    $ol.empty();

    link.parents('li').each(function(n, li) {
      var $a = $(li).children('a');
      $ol.prepend('<li class="breadcrumb-item"><a href="' + $a.attr('href') + '">' + $a.text() + '</a></li>');
    });
  }
});
