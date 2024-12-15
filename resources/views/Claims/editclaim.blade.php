<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Claim</title>
    @include('claims.bootstrap') <!-- Assuming you have Bootstrap included -->
</head>
<body>
    <div class="container">
        <h2>Edit Claim</h2>
        <form action="{{ route('claims.update', $claim->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- This will send a PUT request -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $claim->username }}" required>
            </div>
            <div class="form-group">
                <label for="type">Type of Claim</label>
                <input type="text" name="type" id="type" class="form-control" value="{{ $claim->type }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $claim->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Claim</button>
        </form>
    </div>
</body>
</html>