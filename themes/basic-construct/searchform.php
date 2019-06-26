
<div class="search-form text-center">
  <form id="form-search" role="search" action="<?=site_url('/')?>" method="get" class="search">
    <input type="hidden" name="post_type" value="posts"/>
    <div class="row">
      <h4>Search </h4>
    </div>
    <div class="row">
      <div class="form-group">
        <div class="input-group">
          <div class="icon-addon addon-lg">
              <input id="inp-search" name="s" type="text" placeholder="Search" class="form-control" id="search-posts">
          </div>
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit" alt="Search" value="Search">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </span>
        </div>
      </div>
    </div>
	</form>
</div>
