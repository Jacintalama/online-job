<ul class="list-group list-group-flush">
    <li class="list-group-item {{ Request::is('applicant/dashboard') ? 'active' : '' }}">
        <a href="{{ route('applicant.dashboard') }}">Dashboard</a>
    </li>
    <li class="list-group-item {{ Request::is('applicant/applications') ? 'active' : '' }}">
        <a href="{{ route('applicant_applications') }}">Applied Jobs </a>
    </li>
    
   <li class="list-group-item {{ Request::is('applicant/bookmark-view') ? 'active' : '' }}">
    <a href="{{ route('applicant.bookmark-view') }}">Bookmarked Jobs</a>
</li>

   
</ul>