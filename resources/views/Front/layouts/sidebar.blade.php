<div id="mySidebar" class="sidebar" onmouseover="toggleSidebar()" onmouseout="toggleSidebar()" style="width: 80px;">
  <a href="{{ url('/user/user_dashboard') }}" class="logo-box"><span class="favi-logo"><img src="{{ url('/public') }}/assets/img/m.png"> </span><span class="icon-text"><img src="{{ url('/public') }}/assets/img/text-logo.png"></span></a><br>
  
<a href="{{ url('/user/user_dashboard') }}"><i class="material-symbols-outlined">
grid_view
</i><span class="icon-text">Home</span></a><br>

<a href="{{ url('/user/exam_builder') }}"><i class="material-symbols-outlined">
content_paste_search
</i><span class="icon-text"></span>Exam Builder</a>
<br>

<a href="{{ url('/user/user_status') }}"><i class="material-symbols-outlined">
pie_chart
</i>
<span class="icon-text"></span>User Status</a><br>

<a href="{{ url('/user/settings') }}"><i class="material-symbols-outlined">
settings
</i><span class="icon-text"></span>Settings<span></span></a>
</div>