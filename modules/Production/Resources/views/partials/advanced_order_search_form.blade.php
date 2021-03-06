<div class="style_switcher" style="width: 70%">
    <div class="panel panel-default">
        <div class="panel-heading bg bg-primary text-center">
                <h3>Advanced Search</h3>
        </div>
    </div>
    <div>
        <div class="col-sm-5">
            <select style="width:100%" class="inline-search" ng-model="report.field" ng-change="advanced_search_order()">
                <option value="">Select Option</option>
                <option value="buyer_id">Buyer</option>
                <option value="style_id">Style</option>
                <option value="order_date">Order Date</option>
                <option value="delivery_date">Delivery Date</option>
                <option value="gg">GG</option>
                <option value="qty">Qty</option>
                <option value="fob">FOB</option>
                <option value="composition">Composition</option>
                <option value="weight_per_dzn ">Weight Per Dzn</option>
                <option value="qty_per_dzn ">Qty Per Dzn</option>
                <option value="total_yarn_weight">Total Yarn Weight</option>
                <option value="total_yarn_cost ">Total Yarn Cost</option>
                <option value="acc_rate">Accessories Rate</option>
                <option value="total_acc_cost">Total Accessories Cost</option>
                <option value="btn_cost">Button Rate</option>
                <option value="total_btn_cost">Total Button Cost</option>
                <option value="zipper_cost">Zipper Rate</option>
                <option value="total_zipper_cost">Total Zipper Cost</option>
                <option value="print_cost">Print Rate</option>
                <option value="total_print_cost">Total Print Cost</option>
                <option value="security_tag_cost">Security Tag Cost</option>
                <option value="total_security_tag_cost">Total Security Tag Cost</option>
                <option value="total_fob">Total FOB</option>
                <option value="total_cost">Total Cost</option>
                <option value="balance_amount">Balance Amount</option>
                <option value="cost_of_making">Cost of Making</option>
                <option value="user_id">Created By</option>
                <option value="created_at">Created At</option>
                <option value="updated_at">Created At</option>
            </select>
        </div>
        <div class="col-sm-2">
            <select style="width:100%"  class="inline-search" ng-model="report.operator" ng-change="advanced_search_order()">
                <option value="">Operator</option><option value="=">=</option><option value="&gt;">&gt;</option><option value="&gt;=">&gt;=</option><option value="&lt;">&lt;</option><option value="&lt;=">&lt;=</option><option value="!=">!=</option><option value="LIKE">LIKE</option><option value="NOT LIKE">NOT LIKE</option></select>
            
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control" placeholder="Search" ng-model="report.search_value" ng-change="advanced_search_order()">
        </div>

        <div class="sepH_c col-sm-12" style="top:12px; position: relative;">
            <div class="text-center">
                <button class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Save Report</button>
            </div>
        </div>
    </div>



</div>