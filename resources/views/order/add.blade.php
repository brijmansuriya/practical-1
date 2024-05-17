@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a id="addnew" class="btn btn-primary mt-2">Add New</a>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="form" class="mt-2" action="{{ route('order.store') }}" method="Post">@csrf
                    <div class="mb-3">
                        <label for="user" class="form-label">Users</label>
                        <select name="user_id" class="form-select" aria-label="Default select example" id="">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"> {{ $user->id }} | {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row" id="procudt_0">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="product" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product[]" id="product"
                                    placeholder="Enter Product Name" value="" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount[]" id="amount"
                                    placeholder="Enter Amount " value="" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Opretion</label>
                                <button type="button" class="form-control btn btn-primary delete"
                                    id="delete">Remove</button>
                            </div>
                        </div>
                    </div>
                    <div id="add_new_product"></div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

                <div class="row mt-5">
                    <div class="col-6">Totle</div>
                    <div class="col-6">
                        <div id="totle">0</div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $("#addnew").click(function() {
                $("#procudt_0").clone().find("input").val("").end().appendTo("#add_new_product");
                getTotle();
            });
        });

        //remove button product row delete  
        $("body").on('click', ".delete", function() {
            if ($('#form').find(".row").length > 1) {
                $(this).closest(".row").remove();
                removeButton();
                getTotle();
            }
        });

        //get totle function
        function getTotle() {
            var fullTotle = 0;
            $('#form').find('input[type=number]').each(function() {
                if (parseInt($(this).val()) > 0) {
                    fullTotle += parseInt($(this).val());
                }
            });
            removeButton();
            $("#totle").text(fullTotle.toString());
        }

        function removeButton() {
            // Hide all
            $('#form').find('.delete').hide();

            // new last row
            $('#form').find('.row').last().find(".delete").show();
        }

        //chnge time calculet
        $(document).on('change', 'input[type=number]', function() {
            getTotle();
        });
    </script>
@endsection
