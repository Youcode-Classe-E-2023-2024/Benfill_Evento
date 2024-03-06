<div>
    <form action="route('events.create')" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="title" name="title">
        <input type="text" placeholder="description" name="description">
        <input type="file" accept="image" placeholder="picture" name="picture">
        <select name="location" id="">
            <option value=""></option>
        </select>
        <select name="category" id="">
            <option value=""></option>
        </select>
        <input type="number" placeholder="places" name="places">
        <input type="number" placeholder="price" name="price">
        <select name="organizer" id="">
            <option value=""></option>
        </select>
        <input type="datetime" name="date" id="">
    </form>
</div>
