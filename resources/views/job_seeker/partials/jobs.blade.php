

  @forelse ($jobs as $job)
  <!-- -->
  <div class="card px-2 py-3 mt-1" >
      <div class="row d-flex justify-content-between">
        <div class="col col-md-10" style="line-height: 0">
          <h4>{{ $job->title }}</h4>
          <p class="small">{{ $job->created_at->format('M d, Y') }}</p>
          <p class="small">{{ $job->employer->company_name }}</p>
        </div>
        <div class="col col-md-2">
          <form action="{{ route('bookmark.store',$job) }}" method="post">
              @csrf
              <button @disabled(in_array($job->id,$bookmark_job_ids)  ) type="submit" class="btn btn-outline-secondary text-dark float-end"><i class="fa-solid fa-bookmark "></i></button>
          </form>
          
        </div>
      </div>
  
      <div class="row">
        <div class="col col-md-12">
          <p style="text-align: justify; text-justify: inter-word;  overflow: hidden; text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 4; line-clamp: 4; -webkit-box-orient: vertical;">{{ $job->description }}</p>
        </div>
      </div>
  
      <div class="row">
        <div class="col col-md-10 col-sm-10">
          <span>
              <span class="fa-solid fa-briefcase"></span>
              <span>{{ $job->work_type }}</span>
          </span>
          @if(in_array($job->work_type,['Onsite','Hybrid']))
          <span>
              <i class="fa-solid fa-location-pin"></i>
              <span>{{ $job->location }}</span>
          </span>
          @endif
          <span>
              <i class="fa-solid fa-money-check-dollar"></i>
              <span>{{ '₱'.number_format($job->salary,2) }}</span>
          </span>
        </div>
        <div class="col col-md-2 col-sm-2">
          <a href="{{ route('job_seeker.jobs.show',$job) }}" class="float-end">See more</a>
        </div>
      </div>
    </div>
  <!-- -->
  @empty
      <div class="d-flex align-items-center justify-content-center my-2 p-5">
          <h3 class="text-center py-2">No Jobs Found.</h3>
      </div>
  @endforelse

  <div class="my-2 py-2" id="job-links">
    {{ $jobs->appends(['selectedOption' => $selectedOption])->links() }}
  </div>

