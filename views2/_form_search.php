


<form data-url="<?= $frm_search_url ?>" id="frm_search" action="/search-results" method="GET" class="relative flex items-center w-1/3 ml-auto">
  <input name="query" type="text" 
  class="w-full pl-7 bg-slate-200" 
  placeholder="Search"
  oninput="search_users()"
  onfocus="document.querySelector('#query_results').classList.remove('hidden')"
  onblur="document.querySelector('#query_results').classList.add('hidden')"
  >
  <button class="absolute flex items-center">
    <span class="material-symbols-outlined ml-1 font-thin">
      search
    </span>            
  </button>
  <div id="query_results" 
  class="hidden absolute top-full w-full h-48 bg-white border 
  border-slate-300 overflow-hidden overflow-y-visible">        
  </div>
</form>