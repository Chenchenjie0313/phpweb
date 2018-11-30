
<div class="modal left-siderbar" id="leftMenuView">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><img src="/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.8">メーニュ</h4>
        <button type="button" class="close" data-dialog="close">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <div class="mt-2 list004">
        <ul class="nav nav-pills flex-column">
            <li>
                <a href="javascript:void(0)" data-pageid="homeView" >
                    <i class="fa fa-home"></i>
                    <span>ホーム</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-submenu="#blogSubMenu">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <span>1.ブログ</span>
                    <i class="right fa fa-angle-left"></i>
                </a>
                <ul class="nav nav-pills flex-column" id="blogSubMenu">
                <li>
                    <a href="javascript:void(0)" data-modalid="loginView" data-url="/templete/login.txt" data-data-type="HTML" >
                        <i class="fa fa-circle-o nav-icon"></i>
                        <span>ログイン</span>
                    </a>
                <li>
                <li>
                    <a href="javascript:void(0)" data-modalid="showUploadListView" data-url="/templete/upload.txt" data-data-type="HTML" >
                        <i class="fa fa-circle-o nav-icon"></i>
                        <span>アップロード</span>
                    </a>
                <li>
                <li>
                    <a href="javascript:void(0)" data-pageid="showEditView" data-url="/templete/editCard.txt" data-data-type="HTML" >
                        <i class="fa fa-circle-o nav-icon"></i>
                        <span>エディタ</span>
                    </a>
                <li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" data-pageid="showListCard" data-url="/?action=setting&method=templeteList&dataType=html" data-data-type="HTML"  >
                    <i class="nav-icon fa fa-tree"></i>
                    <span>お知らせ</span>
                    <span class="right badge badge-danger">🌟</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-pageid="foodMenuList" data-url='/templete/footMenuList.txt' data-data-type="HTML" >
                    <i class="nav-icon fa fa-tree"></i>
                    <span>料理</span>
                    <span class="right badge badge-danger">NEW</span>
                    
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-modalid="link" data-url='/templete/link.txt' data-data-type="HTML" >
                    <i class="nav-icon fa fa-tree"></i>
                    <span>リンク</span>
                    <span class="right badge badge-danger">NEW</span>
                    
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-pageid="help" data-url='/templete/help.txt' data-data-type="HTML" >
                    <i class="nav-icon fa fa-tree"></i>
                    <span>ヘルプ</span>
                </a>
            </li>
            <li>&nbsp;</li>
            <li>
                <a href="javascript:void(0)" data-templateid="todo">
                    <i class="nav-icon fa fa-tree"></i>
                    <span>TODO</span>
                </a>
            </li>
            <li>&nbsp;</li>
        </ul>
      </div>
      
      </div>
    </div>
  </div>
</div>