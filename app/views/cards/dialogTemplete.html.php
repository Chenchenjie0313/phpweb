
<script script type="text/template" id="dialogTemplate">
<div class="modal alter-dialog" id="<%= id %>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dialog="close">&times;</button>
      </div>
      <div class="modal-body"><%= bodyContent %></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dialog="close">Close</button>
      </div>
    </div>
  </div>
</div>
</script>
