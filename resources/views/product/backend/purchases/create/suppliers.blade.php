 <div class="flex flex-col space-y-3 p-2">
     @if(count($suppliers) > 0)
     @foreach($suppliers as $item)
     <a class="item flex items-center hover:text-danger js_handle_suppliers" href="javascript:void(0)" data-id="{{$item->id}}" data-info="<?php echo base64_encode(json_encode($item)); ?>">
         <div class="w-10 h-10 rounded-full">
             <img src="https://ui-avatars.com/api/?name={{$item->title}}" class="rounded-full w-full">
         </div>
         <span class="flex ml-2">
             {{$item->title}} - {{$item->phone}}
         </span>
     </a>
     @endforeach
     @endif
 </div>
 <div class="paginationSuppliers flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center py-2 border-t ">
     {{$suppliers->links()}}
 </div>