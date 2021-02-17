ceholder="Stock inicial" value="0" name="stock_prod">
                            @if($errors->has('stock_prod'))
                            <div class="ml-1 text-danger">
                                {{$errors->first('stock_prod')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@if($errors->any())
<script>
$(document).ready(function() {
    $("#registrarProductoModal").modal("show");
});
</script>
@endif
@endsection