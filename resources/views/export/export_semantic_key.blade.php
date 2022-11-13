<table>
    <thead>
    <tr>
        <td><b>Ключевый слова</b></td>
        <td><b>Минус слова</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach($SemanticCoreKeys as $SemanticCoreKeys_item)
        <tr>
            <td>@if($SemanticCoreKeys_item['type']){{$SemanticCoreKeys_item['name']}}@endif</td>
            <td>@if(!$SemanticCoreKeys_item['type']){{$SemanticCoreKeys_item['name']}}@endif</td>
        </tr>
    @endforeach
    </tbody>
</table>
