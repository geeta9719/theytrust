<template>
  <div class="ghs" ref="root">
    <div class="ghs-input">
      <input
        type="search"
        v-model="query"
        @input="onInput"
        @focus="openDropdown"
        @keydown.down.prevent="onArrow(1)"
        @keydown.up.prevent="onArrow(-1)"
        @keydown.enter.prevent="onEnter"
        @keydown.esc.prevent="closeDropdown"
        :placeholder="placeholder"
        aria-autocomplete="list"
        :aria-expanded="isOpen.toString()"
        aria-haspopup="listbox"
        role="combobox"
      />
      <button v-if="query" class="clear-btn" @click="clear">✕</button>
    </div>

    <teleport to="body">
      <div v-if="isOpen" class="ghs-dropdown" role="listbox" :aria-activedescendant="activeId" :style="dropdownStyle">
      <div v-if="loading" class="ghs-loading">Loading...</div>

      <template v-if="!loading">
        <div v-if="hasAnyResult" class="groups">
          <div v-if="results.companies.length" class="group">
            <div class="group-head">Companies</div>
            <ul>
              <li v-for="(c, i) in results.companies" :key="'comp-'+i"
                  :class="itemClass(flatIndex('company', i))"
                  :id="itemId(flatIndex('company', i))"
                  @click="onClick('company', c)"
                  @mouseover="setActive(flatIndex('company', i))"
              >
                <a href="javascript:void(0)"><span v-html="highlight(c.name)"></span></a>
              </li>
            </ul>
          </div>

          <div v-if="results.categories.length" class="group">
            <div class="group-head">Categories</div>
            <ul>
              <li v-for="(cat, i) in results.categories" :key="'cat-'+i"
                  :class="itemClass(flatIndex('category', i))"
                  :id="itemId(flatIndex('category', i))"
                  @click="onClick('category', cat)"
                  @mouseover="setActive(flatIndex('category', i))"
              >
                <a href="javascript:void(0)"><span v-html="highlight(cat.name)"></span></a>
              </li>
            </ul>
          </div>

          <div v-if="results.subcategories.length" class="group">
            <div class="group-head">Subcategories</div>
            <ul>
              <li v-for="(sc, i) in results.subcategories" :key="'sub-'+i"
                  :class="itemClass(flatIndex('subcategory', i))"
                  :id="itemId(flatIndex('subcategory', i))"
                  @click="onClick('subcategory', sc)"
                  @mouseover="setActive(flatIndex('subcategory', i))"
              >
                <a href="javascript:void(0)"><span v-html="highlight(sc.name)"></span></a>
              </li>
            </ul>
          </div>

          <div v-if="results.locations.length" class="group">
            <div class="group-head">Locations</div>
            <ul>
              <li v-for="(loc, i) in results.locations" :key="'loc-'+i"
                  :class="itemClass(flatIndex('location', i))"
                  :id="itemId(flatIndex('location', i))"
                  @click="onClick('location', loc)"
                  @mouseover="setActive(flatIndex('location', i))"
              >
                <a href="javascript:void(0)"><span v-html="highlight(loc.name)"></span></a>
              </li>
            </ul>
          </div>
        </div>

        <div v-else class="no-results">No results found</div>
      </template>
      </div>
    </teleport>
  </div>
</template>

<script>
export default {
  name: 'GlobalHeaderSearch',
  props: {
    placeholder: { type: String, default: 'Search companies, categories, locations...' },
    minChars: { type: Number, default: 1 }
  },
  data() {
    return {
      query: '',
      results: { companies: [], categories: [], subcategories: [], locations: [] },
      isOpen: false,
      loading: false,
      highlightedIndex: -1,
      debounceTimer: null,
      abortController: null
      ,dropdownStyle: {}
    };
  },
  computed: {
    hasAnyResult() {
      return (
        (this.results.companies && this.results.companies.length) ||
        (this.results.categories && this.results.categories.length) ||
        (this.results.subcategories && this.results.subcategories.length) ||
        (this.results.locations && this.results.locations.length)
      );
    },
    flattened() {
      const list = [];
      ['companies','categories','subcategories','locations'].forEach(type => {
        (this.results[type] || []).forEach(item => list.push({ type, item }));
      });
      return list;
    },
    activeId() {
      return this.highlightedIndex >= 0 ? 'ghs-item-' + this.highlightedIndex : null;
    },
    flatLength() {
      return this.flattened.length;
    }
  },
  methods: {
    onInput() {
      this.openDropdown();
      this.debounceFetch();
    },
    openDropdown() {
      this.isOpen = true;
      this.addOutsideClick();
      this.updateDropdownPosition();
      this.addWindowListeners();
      if (this.query.length >= this.minChars) this.debounceFetch();
    },
    closeDropdown() {
      this.isOpen = false;
      this.highlightedIndex = -1;
      this.removeOutsideClick();
      this.removeWindowListeners();
    },
    clear() {
      this.query = '';
      this.results = { companies: [], categories: [], subcategories: [], locations: [] };
      this.closeDropdown();
    },
    debounceFetch() {
      clearTimeout(this.debounceTimer);
      this.debounceTimer = setTimeout(() => {
        this.fetchResults();
      }, 300);
    },
    async fetchResults() {
      const q = (this.query || '').trim();
      if (q.length < this.minChars) {
        this.results = { companies: [], categories: [], subcategories: [], locations: [] };
        this.loading = false;
        return;
      }

      if (this.abortController) this.abortController.abort();
      this.abortController = new AbortController();
      this.loading = true;

      try {
        const url = '/api/search-main?q=' + encodeURIComponent(q);
        const res = await fetch(url, { signal: this.abortController.signal, credentials: 'same-origin' });
        if (!res.ok) throw new Error('Network error');
        const json = await res.json();

        this.results = {
          companies: Array.isArray(json.companies) ? json.companies : [],
          categories: Array.isArray(json.categories) ? json.categories : [],
          subcategories: Array.isArray(json.subcategories) ? json.subcategories : [],
          locations: Array.isArray(json.locations) ? json.locations : []
        };

        // expose results for debugging in DOM dataset
        try {
          if (this.$refs.root && this.$refs.root.dataset) {
            this.$refs.root.dataset.ghs = JSON.stringify(this.results);
          }
        } catch (e) {
          // ignore
        }

        this.highlightedIndex = this.flatLength ? 0 : -1;
      } catch (err) {
        if (err.name !== 'AbortError') {
          this.results = { companies: [], categories: [], subcategories: [], locations: [] };
        }
      } finally {
        this.loading = false;
      }
    },
    highlight(text) {
      if (!this.query) return this.escapeHtml(text);
      const q = this.escapeRegExp(this.query.trim());
      const re = new RegExp('(' + q + ')', 'ig');
      return this.escapeHtml(text).replace(re, '<mark>$1</mark>');
    },
    escapeHtml(str) {
      return String(str).replace(/[&<>"'`=\/]/g, function(s) {
        return ({
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"': '&quot;',
          "'": '&#39;',
          '/': '&#x2F;',
          '`': '&#x60;',
          '=': '&#x3D;'
        })[s];
      });
    },
    escapeRegExp(string) {
      return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    },
    onClick(type, data) {
      // Use /companies/ route for category/subcategory/location per request
      let url = '/';
      const slug = data.slug || '';
      if (type === 'company') {
        url = '/company/' + encodeURIComponent(slug);
      } else if (type === 'category' || type === 'subcategory' || type === 'location') {
        url = '/companies/' + encodeURIComponent(slug);
      }
      window.location.href = url;
    },
    flatIndex(type, idx) {
      let base = 0;
      const order = ['companies','categories','subcategories','locations'];
      for (const t of order) {
        if (t === type) return base + idx;
        base += (this.results[t] || []).length;
      }
      return -1;
    },
    itemClass(flatIdx) {
      return { 'ghs-item': true, 'active': flatIdx === this.highlightedIndex };
    },
    itemId(flatIdx) {
      return 'ghs-item-' + flatIdx;
    },
    setActive(idx) {
      this.highlightedIndex = idx;
    },
    onArrow(direction) {
      if (!this.isOpen) { this.openDropdown(); return; }
      const len = this.flatLength;
      if (!len) return;
      let next = this.highlightedIndex;
      if (next === -1) next = direction > 0 ? 0 : len - 1;
      else {
        next = (next + direction + len) % len;
      }
      this.highlightedIndex = next;
      this.scrollActiveIntoView();
    },
    onEnter() {
      if (this.highlightedIndex < 0) return;
      const entry = this.flattened[this.highlightedIndex];
      if (!entry) return;
      this.onClick(entry.type, entry.item);
    },
    scrollActiveIntoView() {
      this.$nextTick(() => {
        const el = document.getElementById(this.activeId);
        if (el && el.scrollIntoView) el.scrollIntoView({ block: 'nearest' });
      });
    },
    updateDropdownPosition() {
      this.$nextTick(() => {
        if (!this.$refs.root) return;
        const rootRect = this.$refs.root.getBoundingClientRect();
        this.dropdownStyle = {
          position: 'fixed',
          left: rootRect.left + 'px',
          top: (rootRect.bottom + 8) + 'px',
          width: rootRect.width + 'px',
          zIndex: 30000
        };
      });
    },
    addWindowListeners() {
      window.addEventListener('resize', this.updateDropdownPosition);
      window.addEventListener('scroll', this.updateDropdownPosition, true);
    },
    removeWindowListeners() {
      window.removeEventListener('resize', this.updateDropdownPosition);
      window.removeEventListener('scroll', this.updateDropdownPosition, true);
    },
    addOutsideClick() {
      document.addEventListener('click', this.outsideClickHandler);
    },
    removeOutsideClick() {
      document.removeEventListener('click', this.outsideClickHandler);
    },
    outsideClickHandler(e) {
      if (!this.$refs.root) return;
      if (!this.$refs.root.contains(e.target)) this.closeDropdown();
    }
  },
  beforeUnmount() {
    this.removeOutsideClick();
    clearTimeout(this.debounceTimer);
    if (this.abortController) this.abortController.abort();
  },
  watch: {
    results: {
      handler() { },
      deep: true
    }
  },
  // merge flatLength into computed above
  
};
</script>

<style scoped>
.ghs { position: relative; display: block; width: 100%; max-width: none; }
.ghs-input { position: relative; }
.ghs-input input[type="search"] {
  width: 100%;
  min-width: 200px;
  box-sizing: border-box;
  padding: 10px 36px 10px 12px;
  border-radius: 8px;
  border: 1px solid #ddd;
  font-size: 14px;
  outline: none;
}
.ghs-input input[type="search"]:focus { box-shadow: 0 4px 14px rgba(0,0,0,0.06); border-color:#cbd5e0; }
.clear-btn {
  position: absolute;
  right: 8px;
  top: 6px;
  background: transparent;
  border: none;
  cursor: pointer;
  font-size: 14px;
  padding: 6px;
}
.ghs-dropdown {
  position: absolute;
  left: 0;
  right: 0;
  top: calc(100% + 8px);
  background: #fff;
  border-radius: 8px;
  border: 1px solid rgba(15,15,15,0.06);
  box-shadow: 0 8px 28px rgba(13,18,30,0.08);
  z-index: 3000;
  max-height: 420px;
  overflow: auto;
  padding: 8px;
}
.ghs-loading { padding: 12px; color:#666; }
.group { padding: 6px 8px; border-bottom: 1px solid #f1f5f9; }
.group:last-child { border-bottom: none; }
.group-head { font-weight: 700; color:#111827; padding: 6px 2px; font-size: 13px;}
ul { margin: 0; padding: 0 6px 6px 6px; list-style: none; }
li.ghs-item { padding: 8px 6px; border-radius: 6px; cursor: pointer; display:flex; align-items:center; }
li.ghs-item a { color: #111827; text-decoration: none; width:100%; display:inline-block; }
li.ghs-item.active { background: #f1f5f9; }
.no-results { padding: 12px; color:#666; text-align:center; }
mark { background: #ffe58f; color: #111827; padding:0 2px; border-radius:3px; }
</style>
