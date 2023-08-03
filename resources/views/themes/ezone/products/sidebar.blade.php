<div class="shop-sidebar mr-50">
    <form method="GET" action="{{ url('products')}}">
		<div class="sidebar-widget mb-40">
			<h3 class="sidebar-title">Filter by Price</h3>
			<div class="price_filter">
				<div id="slider-range"></div>
				<div class="price_slider_amount">
					<div class="label-input">
						<label>price : </label>
						<input type="text" id="amount" name="price"  placeholder="Add Your Price" style="width:170px" />
						<input type="hidden" id="productMinPrice" value=""/>
						<input type="hidden" id="productMaxPrice" value=""/>
					</div>
					<button type="submit">Filter</button> 
				</div>
			</div>
		</div>
    </form>

    
		<div class="sidebar-widget mb-45">
			<h3 class="sidebar-title">Categories</h3>
			<div class="sidebar-categories">
			</div>
		</div>

    
		<div class="sidebar-widget sidebar-overflow mb-45">
			<h3 class="sidebar-title">color</h3>
			<div class="sidebar-categories">
		
			</div>
		</div>

		<div class="sidebar-widget mb-40">
			<h3 class="sidebar-title">size</h3>
			<div class="product-size">
			
			</div>
		</div>
</div>