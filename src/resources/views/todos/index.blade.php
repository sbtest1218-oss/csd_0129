<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
            padding: 40px 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .add-form {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }
        .add-form input[type="text"] {
            flex: 1;
            padding: 12px 16px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            outline: none;
        }
        .add-form input[type="text"]:focus {
            border-color: #007bff;
        }
        .add-form button {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .add-form button:hover {
            background-color: #0056b3;
        }
        .todo-list {
            list-style: none;
        }
        .todo-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background-color: white;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .todo-item.completed .todo-title {
            text-decoration: line-through;
            color: #999;
        }
        .todo-title {
            flex: 1;
            font-size: 16px;
            color: #333;
        }
        .btn {
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-toggle {
            background-color: #28a745;
            color: white;
        }
        .btn-toggle:hover {
            background-color: #1e7e34;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .empty-message {
            text-align: center;
            color: #999;
            padding: 40px;
        }
        .error {
            color: #dc3545;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Todo App</h1>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('todos.store') }}" method="POST" class="add-form">
            @csrf
            <input type="text" name="title" placeholder="新しいタスクを入力..." value="{{ old('title') }}">
            <button type="submit">追加</button>
        </form>

        @if($todos->isEmpty())
            <p class="empty-message">タスクがありません</p>
        @else
            <ul class="todo-list">
                @foreach($todos as $todo)
                    <li class="todo-item {{ $todo->completed ? 'completed' : '' }}">
                        <span class="todo-title">{{ $todo->title }}</span>
                        <form action="{{ route('todos.update', $todo) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-toggle">
                                {{ $todo->completed ? '未完了に戻す' : '完了' }}
                            </button>
                        </form>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">削除</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
