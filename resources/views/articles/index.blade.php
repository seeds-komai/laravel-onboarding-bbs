<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>オンボーディング掲示板</title>
    <style>
        textarea {
            resize: vertical;
        }
        textarea, input[type=text] {
            border: solid 1px gray;
            box-sizing: border-box;
            padding: 4px;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>オンボーディング掲示板</h1>
    </header>
    <main>
        <ul>
            @foreach ($articles as $article)
                <li>
                    <div>
                        {{$article->id}}:&nbsp;{{$article->name}}&nbsp;{{$article->updated_at}}
                    </div>
                    <div>{{$article['content']}}</div>
                    <div style="display: inline-flex;">
                        <form action="{{route('articles.edit',$article)}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$article['id']}} ">
                            <button type="submit">編集</button>
                        </form>
                        &nbsp;
                        <form action="{{ route('articles.confirm_destroy',$article)}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$article['id']}}">
                            <button type="submit">削除</button>
                        </form>
                    </div>
                </li>
                <br/>
            @endforeach
        </ul>
        <div>
            <form action="{{ route('articles.confirm_store') }}" method="post">
                <table>
                    @csrf
                    <thead>
                    <tr>
                        <th colspan="2">新規投稿</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th><label for="name">名前</label></th>
                        <td><input type="text" name="name" id="name" required></td>
                    </tr>
                    <tr>
                        <th><label for="content">投稿内容</label></th>
                        <td><textarea name="content" id="content" rows="4" required></textarea></td>
                    </tr>
                    </tbody>
                </table>
                <button type="submit">投稿</button>
            </form>
        </div>
    </main>
    <footer>
        <hr>
        <div>(b・ω・)b</div>
    </footer>
</body>
</html>
