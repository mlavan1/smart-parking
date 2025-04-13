<section class="find_section">
    <div class="container">
        <form action="{{ url('/search') }}" method="get">

        <div class=" form-row">
          <div class="col-lg-3">
            <label for="carlocation">Select Location</label>
            <select name="location" class="form-control" id="carlocation"   >
              <option value="">Jaffna</option>
              <option value="">Kopay</option>
              <option value=""> Kokkuvil</option>
              <option value=""> Nelliyadi</option>
              <option value=""> POint-pedro</option>
            </select>
          </div>
          <div class="col-lg-3">
            <label for="parkingDate">Select Your Date</label>
            <input type="date" name= "date" class="form-control"id="parkingDate" placeholder=" "  >
          </div>

          <div class="col-lg-3">
            <label for="parkingTime">Select Your Time</label>
            <input type="time"name="time" class="form-control" id="parkingTime" placeholder=" " >
          </div>
          <div class="col-lg-3">
            <div class="btn-container">
              <button type="submit" class="">
                Search Slots
              </button>
            </div>
          </div>
        </div>

      </form>
    </div>
  </section>
