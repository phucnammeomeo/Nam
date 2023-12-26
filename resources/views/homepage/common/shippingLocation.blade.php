<?php

$listCity = getListCity();

$listDistrict = getListDistrict();

$listWard = getListWard();

$city_id = $district_id = $ward_id = '';

$shipLocation = Session::get('location');

if( $shipLocation ){

    $city_id = $shipLocation['cityid'];

    $district_id = $shipLocation['districtid'];

    $ward_id = $shipLocation['wardid'];

}

?>

<div class="modal">

    <div class="modal-overlay modal-toggle"></div>

    <div class="modal-wrapper modal-transition">

        <div class="modal-header">

            <button class="modal-close modal-toggle">

                <i class="fa-solid fa-xmark"></i>

            </button>

            <h2 class="modal-heading">Địa chỉ giao hàng</h2>

        </div>

        <div class="modal-body">

            <div class="modal-content">

                <p class="desc pb-[15px]">

                    Quý khách vui lòng chọn khu vực giao hàng dự kiến

                </p>

                <form action="">

                    <div class="flex flex-wrap justify-between mx-[-10px] items-center mb-[15px]">

                        <div class="w-full md:w-2/5 px-[10px]">

                            <label for="" class="text-f14">Tỉnh/Thành phố</label>

                        </div>

                        <div class="w-full md:w-3/5 px-[10px]">

                            <?php

                            echo Form::select('ship_city', $listCity, $city_id, ['class' => 'select-filter_ w-full h-[40px] border border-gray-200 rounded-[5px] text-f14', 'id' => 'ship_city']);

                            ?>

                        </div>

                    </div>

                    <div class="flex flex-wrap justify-between mx-[-10px] items-center mb-[15px]">

                        <div class="w-full md:w-2/5 px-[10px]">

                            <label for="" class="text-f14">Quận/Huyện</label>

                        </div>

                        <div class="w-full md:w-3/5 px-[10px]">

                            <?php

                            echo Form::select('ship_district', $listDistrict, $district_id, ['class' => 'select-filter_ w-full h-[40px] border border-gray-200 rounded-[5px] text-f14', 'id' => 'ship_district', 'placeholder' => trans('index.District')]);

                            ?>

                        </div>

                    </div>

                    <div class="flex flex-wrap justify-between mx-[-10px] items-center mb-[15px]">

                        <div class="w-full md:w-2/5 px-[10px]">

                            <label for="" class="text-f14">Phường/Xã</label>

                        </div>

                        <div class="w-full md:w-3/5 px-[10px]">

                            <?php

                            echo Form::select('ship_ward', $listWard, $ward_id, ['class' => 'select-filter_ w-full h-[40px] border border-gray-200 rounded-[5px] text-f14', 'id' => 'ship_ward', 'placeholder' => trans('index.Ward')]);

                            ?>

                        </div>

                    </div>

                </form>

                <div class="desc-2 text-center ship-information">{!! (isset($shipLocation) && is_array($shipLocation) && count($shipLocation))?$shipLocation['description']:'' !!}</div>

            </div>

        </div>

    </div>

</div>
