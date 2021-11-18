<div class='btn-group'>
    <a href={{url("tarifaProgramaChileCrece/$id/edit")}} title='Editar' class='btn btn-warning btn-xs'><i class='fa fa-edit' style='color:white'></i></a>
    <form action='{{ route('tarifaProgramaChileCrece.destroy', $id) }}' method='POST'>
        @csrf
        @method('DELETE')
        <button onclick="return confirm('¿Esta seguro que desea eliminar esta tarifa?');" type='submit' class='btn btn-danger btn-xs'><i class='fa fa-trash' style='color:white'></i></button>
    </form>
</div>