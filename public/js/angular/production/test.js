angular.module('myApp').controller('SupplierTypesController', function($scope, $http) {
    $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
    $http.get('/fsdf').then(function (response) {
        $scope.num_of_items = 10;
        $scope.supplier_types = response.data;
        $scope.reverse = false;
        console.log(response.data)
    });
    $scope.sortKey = 'supplier_type_name';
    $scope.sort = function (header) {
        $scope.sortKey = header;
        $scope.reverse = !$scope.reverse;
    };
    $scope.remove_supplier_type = function(id, name, action){
        if(action == 'single_delete')
        {
            $scope.supplier_type_name = name;
            $scope.supplier_type_id = id;
            $scope.status = 'single_delete';
            $scope.modal_msg = "Do you really want to delete the supplier_type "+$scope.supplier_type_name+".";
            $('#remove-supplier_type-modal').modal('toggle');
        }
        else if(action == 'all')
        {
            if($scope.supplier_types.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.supplier_type_id = 0;
                $scope.status = 'all';
                $scope.modal_msg = "Do you really want to delete all supplier_types";
                $('#remove-supplier_type-modal').modal('toggle');
            }
        }
        else if(action == 'selected')
        {
            var arr = [];
            $scope.status = 'selected';
            $('.select_row:checked').each(function() {
                console.log(this.value)
                arr.push(this.value);

            });
            $scope.modal_msg = "Do you really want to delete selected supplier_types";
            if(arr.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.supplier_type_id = arr;
                $('#remove-supplier_type-modal').modal('toggle');
            }
        }
    };
    $scope.remove_supplier_type_confirmed = function(id, page, action){
        $scope.supplier_type_name = null;
        $http.delete('/production/supplier_type/'+id+"/"+action).then(function(response){
            console.log(response)
            $('#remove-supplier_type-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully deleted the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            if(page == 'show_page')
            {
                window.location.href = '/production/supplier_types';
            }
            else
            {
                $http.get('/production/supplier_type/fetchSupplierTypesList').then(function (response) {
                    $scope.num_of_items = 10;
                    $scope.supplier_types = response.data;
                    $scope.reverse = false;
                })
            }
        }, function(error_response){
            $('#remove-supplier_type-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        })
    };
    $scope.init = function(id){
        $http.get('/production/supplier_types/fetchSupplierTypeDetails/'+id).then(function(response){
            $scope.supplier_type = response.data;
        })
    };
    $scope.edit_supplier_type = function (id, edit_item, field, field_type, is_required, min_length, max_length, pattern, error_text) {
        $scope.editable_item = edit_item;
        $scope.supplier_type_id = id;
        $scope.field = field;
        $scope.field_type = field_type;
        $scope.is_required = is_required;
        $scope.min_length = min_length;
        $scope.max_length = max_length;
        $scope.pattern = pattern;
        $scope.error_text = error_text;
        $scope.type = null;
        $('#edit-supplier_type-modal').modal('toggle');
    }
    $scope.edit_supplier_type_confirmed = function (id) {
        $('#edit-supplier_type-modal').modal('toggle');
        if($scope.type == null)
        {
            $scope.type = '--';
        }
        $http.get('/production/supplier_type/update/'+$scope.field+'/'+id+'/'+$scope.type).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully updated the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.supplier_type = response.data;
            $http.get('/production/supplier_types/fetchSupplierTypeDetails/'+id).then(function(response){
                $scope.supplier_type = response.data;
            })
        }, function(response){
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        })
    }
    $scope.add_supplier_type = function(){
        var data = $.param({
            supplier_type_name: $scope.supplier_type_name,
            postal_address: $scope.postal_address,
            contact_person: $scope.contact_person,
            email_address: $scope.email_address,
            contact_number: $scope.contact_number,
            website: $scope.website,
            supplier_type_image: $scope.supplier_type_image
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post('/production/supplier_types', data, config).success(function (result, status) {
            $('#add-supplier_type-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add a supplier_type.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.supplier_type_name = null;
            $http.get('/production/supplier_type/fetchSupplierTypesList').then(function (response) {
                $scope.num_of_items = 10;
                $scope.supplier_types = response.data;
                $scope.reverse = false;
            })
        }).error(function (result, status) {
            $('#add-supplier_type-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.supplier_type_name = null;
        });
    };
})
