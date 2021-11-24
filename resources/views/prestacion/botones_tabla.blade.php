<div class='btn-group' style="line-height: 0">
    <a href={{url("prestacion/$id/edit")}} title='Editar' class='btn btn-warning btn-xs'><i class='fa fa-edit' style='color:white'></i></a>
    <form action='{{ route('prestacion.destroy', $id) }}' method='POST'>
        @csrf
        @method('DELETE')
        <button onclick="return confirm('¿Esta seguro que desea eliminar esta prestacion?');" type='submit' class='btn btn-danger btn-xs'><i class='fa fa-trash' style='color:white'></i></button>
    </form>
</div>