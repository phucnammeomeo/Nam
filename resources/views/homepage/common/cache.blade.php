<?php if (!empty(Auth::user())) { ?>
    <div class="w-full bg-black text-center z-50 button-clear-cache">
        <a href="{{route('homepage.clearCache')}}" class=" font-bold py-2 px-4 rounded neonShadow flex justify-center items-center">Xóa cache</a>
    </div>
<?php } ?>
