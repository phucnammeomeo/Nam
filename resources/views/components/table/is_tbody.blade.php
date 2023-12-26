 @if(!$configIs->isEmpty())
 @foreach($configIs as $item)
 <td class="w-40">
     @include('components.isModule',['module' => $module,'title' => $item->type,'id' =>
     $v->id, 'id' => $item->id])
 </td>
 @endforeach
 @endif
