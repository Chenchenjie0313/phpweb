
<div class="card carouselCard" id="foodCarouselView">
    <div class="card-header">
      <h3 class="card-title">家庭</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <a href="javascript:void(0);" data-operation-id="showEditCard" data-operation-url='/templete/footMenuList.txt' data-operation-pageid='footMenuList'>
                <img class="d-block w-100" src="<?= View::img('car_h_001.jpg'); ?>" alt="First slide">
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0);" data-operation-id="showEditCard" data-operation-url='/templete/footMenuList.txt' data-operation-pageid='footMenuList'>
                <img class="d-block w-100" src="<?= View::img('car_h_002.jpg'); ?>" alt="Second slide">
            </a>
          </div>
          <div class="carousel-item">
            <a href="javascript:void(0);" data-operation-id="showEditCard" data-operation-url='/templete/footMenuList.txt' data-operation-pageid='footMenuList'>
                <img class="d-block w-100" src="<?= View::img('car_h_003.jpg'); ?>" alt="Third slide">
            </a>
          </div>
          <div class="carousel-item clone">
            <img class="d-block w-100" src="<?= View::img('car_h_001.jpg'); ?>" alt="First slide">
          </div>
        </div>

        <a class="carousel-control-prev" href="javascript:void(0);" data-carouse="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="javascript:void(0);" data-carouse="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div><!-- /.card-body -->
    
    <div class="card-footer" style="position:relative;">
        <ol class="indicators">
          <li data-control="show" data-slide-to="1" class="active common-pointer"></li>
          <li data-control="show" data-slide-to="2" class="common-pointer"></li>
          <li data-control="show" data-slide-to="3" class="common-pointer"></li>
        </ol>
    </div><!-- /.card-footer-->
</div>


<div class="card baseShopInfoCard" id="baseShopInfoCard">
  <div class="card-header">
    <h3 class="card-title">マイホーム</h3>
    <div class="card-tools">
      <span class="badge active"><i class="fa fa-star"></i></span>
      <span class="badge active"><i class="fa fa-star"></i></span>
      <span class="badge active"><i class="fa fa-star"></i></span>
      <span class="badge active"><i class="fa fa-star"></i></span>
      <span class="badge active"><i class="fa fa-star"></i></span>
      <span class="badge badge-warning">5</span>

      <button type="button" class="btn btn-tool" data-widget="min"><i class="fa fa-minus"></i></button>
    </div>
  </div><!-- /.card-header -->
  <div class="card-body list-style">
    <div class="ul-list">
      
      <div class="item-style-001 li-item-left">
        <div class="title clearfix">
          <span class="name float-left">子供</span>
        </div>
        <div class="text">
          <div class="card-group common-mb-2">
            <div class="card">
            <img class="card-img-top" src="<?= View::img('a-002.jpg'); ?>" alt="Card image">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text"></p>
                <a href="javascript:void(0);" class="btn btn-primary">More...</a>
            </div>
            </div>
            <div class="card">
            <img class="card-img-top" src="<?= View::img('a-003.jpg'); ?>" alt="Card image">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text"></p>
                <a href="javascript:void(0);" class="btn btn-primary">More...</a>
            </div>
            </div>
            <div class="card">
            <img class="card-img-top" src="<?= View::img('a-001.jpg'); ?>" alt="Card image">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text"></p>
                <a href="javascript:void(0);" class="btn btn-primary">More...</a>
            </div>
            </div>
          </div>
        </div>
      </div>

      <div class="item-style-001 li-item-left">
        <div class="title clearfix">
          <span class="name float-left">料理</span>
        </div>
        <div class="text">
          <div class="card-deck common-mb-2">
            <div class="card">
            <img class="card-img-top" src="<?= View::img('car_a_001.jpg'); ?>" alt="Card image">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text"></p>
                <a href="javascript:void(0);" class="btn btn-primary">More...</a>
            </div>
            </div>
            <div class="card">
            <img class="card-img-top" src="<?= View::img('car_a_002.jpg'); ?>" alt="Card image">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text"></p>
                <a href="javascript:void(0);" class="btn btn-primary">More...</a>
            </div>
            </div>
            <div class="card">
            <img class="card-img-top" src="<?= View::img('car_a_004.jpg'); ?>" alt="Card image">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text"></p>
                <a href="javascript:void(0);" class="btn btn-primary">More...</a>
            </div>
            </div>
          </div>
        </div>
      </div>

      <div class="item-style-001 li-item-left">
        <div class="title clearfix">
          <span class="name float-left">住所</span>
        </div>
        <div class="text">
            <span>千葉県市川市行徳駅前●●●-●●-●● ●●●●●●●●●● □□□□□</span>
            <img src="https://maps.googleapis.com/maps/api/staticmap?client=gme-kakakucominc&channel=tabelog.com&sensor=false&hl=ja&center=35.66828333872132,139.75738448426043&markers=color:red%7C35.66828333872132,139.75738448426043&zoom=15&size=490x145&signature=xN2abkDyU-SYljrrKBcJN5nTHsI="> 
        </div>
      </div>

    </div>
  </div><!-- /.card-body -->

</div>
