<!--Entity modal delete dialog -->
<div class="modal fade" id="delete-entity">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
        <p>{{ __('Do you want to remove item?') }}</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('No') }}</button>
        <form id="destroy-entity" action="#" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary">{{ __('Yes') }}</button>
        </form>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
