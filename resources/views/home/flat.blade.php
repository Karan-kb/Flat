

<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  <span>Flats</span>
               </h2>
               <br><br>
               <div>
                  <form action="{{url('flat_search')}}" methodd="GET">

                  @csrf
                     <input style="width:500px;" type="text" name="search" placeholder="Search Flat" >
                     <input type="submit" value="search">
</form>
</div>
            </div>
            <div class="row">

           
           @foreach($flat as $flats)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('rate_flat',$flats->id)}}" class="option1">
                           Rate this flat
                           </a>
                           <a href="{{url('flat_details',$flats->id)}}" class="option1">
                           Flat Details
                           </a>
                           <form action="{{url('rent',$flats->id)}}" method="Post">
                              @csrf
                              <div class="row">
                                 <div class="col-md-4">
                              <input type="submit" value="Rent">
</div>

</div>
</form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="flat/{{$flats->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$flats->title}}
                        </h5> 
                        <h6>
                        Rs.{{$flats->rent}}/month
                        </h6>

                        
                     </div>
                  </div>
                  
               </div>
               
            @endforeach

            <span style="padding-top:20px;">
            {!!$flat->withQueryString()->links('pagination::bootstrap-5')!!}
</span>
         </div>
      </section>
 