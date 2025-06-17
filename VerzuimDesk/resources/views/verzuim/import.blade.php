

<form action="{{ route('verzuim.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Importeer Excel</button>
</form>
