
angular.module('myApp').controller('AllRequisitionController', function($scope, $http) {
    $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
    $http.get('/production/requisition/fetchAllRequisitionsList').then(function (response) {
        $scope.num_of_items = 10;
        $scope.requisitions = response.data;
        $scope.reverse = false;
    });
    $scope.sortKey = 'requisition_name';
    $scope.sort = function (header) {
        $scope.sortKey = header;
        $scope.reverse = !$scope.reverse;
    };
    $scope.remove_requisition = function(id, name, action){
        if(action == 'single_delete')
        {
            $scope.requisition_name = name;
            $scope.requisition_id = id;
            $scope.status = 'single_delete';
            $scope.modal_msg = "Do you really want to delete the requisition "+$scope.requisition_name+".";
            $('#remove-requisition-modal').modal('toggle');
        }
        else if(action == 'all')
        {
            if($scope.requisitions.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.requisition_id = 0;
                $scope.status = 'all';
                $scope.modal_msg = "Do you really want to delete all requisitions";
                $('#remove-requisition-modal').modal('toggle');
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
            $scope.modal_msg = "Do you really want to delete selected requisitions";
            if(arr.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.requisition_id = arr;
                $('#remove-requisition-modal').modal('toggle');
            }
        }
    };
    $scope.remove_requisition_confirmed = function(id, page, action){
        $scope.requisition_name = null;
        $http.delete('/production/requisition/'+id+"/"+action).then(function(response){
            console.log(response)
            $('#remove-requisition-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully deleted the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            if(page == 'show_page')
            {
                window.location.href = '/production/requisitions';
            }
            else
            {
                $http.get('/production/requisition/fetchAllRequisitionsList').then(function (response) {
                    $scope.num_of_items = 10;
                    $scope.requisitions = response.data;
                    $scope.reverse = false;
                })
            }
        }, function(error_response){
            $('#remove-requisition-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        })
    };
    $scope.init = function(id){
        $http.get('/production/requisitions/fetchAllRequisitionDetails/'+id).then(function(response){
            $scope.requisition = response.data;
        })
    };
    $scope.edit_requisition = function (id, edit_item, field, field_type, is_required, min_length, max_length, pattern, error_text) {
        $scope.editable_item = edit_item;
        $scope.requisition_id = id;
        $scope.field = field;
        $scope.field_type = field_type;
        $scope.is_required = is_required;
        $scope.min_length = min_length;
        $scope.max_length = max_length;
        $scope.pattern = pattern;
        $scope.error_text = error_text;
        $scope.type = null;
        $('#edit-requisition-modal').modal('toggle');
    }
    $scope.edit_requisition_confirmed = function (id) {
        $('#edit-requisition-modal').modal('toggle');
        if($scope.type == null)
        {
            $scope.type = '--';
        }
        $http.get('/production/requisition/update/'+$scope.field+'/'+id+'/'+$scope.type).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully updated the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.requisition = response.data;
            $http.get('/production/requisitions/fetchAllRequisitionDetails/'+id).then(function(response){
                $scope.requisition = response.data;
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
    $scope.add_requisition = function(){
        var data = $.param({
            requisition_name: $scope.requisition_name,
            postal_address: $scope.postal_address,
            contact_person: $scope.contact_person,
            email_address: $scope.email_address,
            contact_number: $scope.contact_number,
            website: $scope.website,
            requisition_image: $scope.requisition_image
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post('/production/requisitions', data, config).success(function (result, status) {
            $('#add-requisition-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add a requisition.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.requisition_name = null;
            $http.get('/production/requisition/fetchAllRequisitionsList').then(function (response) {
                $scope.num_of_items = 10;
                $scope.requisitions = response.data;
                $scope.reverse = false;
            })
        }).error(function (result, status) {
            $('#add-requisition-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.requisition_name = null;
        });
    };
})
