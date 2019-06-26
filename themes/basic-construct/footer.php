  <div id="toTop">
    <a id="toTop" href="#"><span class="fa fa-arrow-up fa-2x"></span></a>
  </div>
  </main>
  <footer>
    <div class="container">
      <div class="wrap text-center">
         <?php
           $menu = wp_nav_menu([
               'menu' => 'Footer',
               'menu_class' => 'list-inline',
               'container' => '',
               'container_class' => '',
               'container_id' => '',
               'walker' => new App\Walker\Footer
             ]);
          ?>
      </div>
    </div>
  </footer>
  <?=wp_footer();?>
</body>
</html>
