/**
 * Header Search - Standalone implementation
 * Does NOT interfere with existing Vue components
 */
(function() {
    'use strict';
    
    // Only run if the header search input exists
    const searchInput = document.getElementById('search');
    if (!searchInput) return;
    
    let debounceTimer = null;
    let abortController = null;
    let isDropdownOpen = false;
    
    // Create dropdown container
    const dropdown = document.createElement('div');
    dropdown.className = 'header-search-dropdown';
    dropdown.style.display = 'none';
    searchInput.parentElement.appendChild(dropdown);
    
    // Add CSS
    const style = document.createElement('style');
    style.textContent = `
        .header-search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 8px 28px rgba(0,0,0,0.1);
            max-height: 400px;
            overflow-y: auto;
            z-index: 9999;
            margin-top: 8px;
        }
        .header-search-group {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
        }
        .header-search-group:last-child {
            border-bottom: none;
        }
        .header-search-group-title {
            font-weight: 700;
            font-size: 13px;
            color: #333;
            margin-bottom: 8px;
        }
        .header-search-item {
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            color: #555;
            transition: background 0.2s;
        }
        .header-search-item:hover {
            background: #f5f5f5;
        }
        .header-search-loading {
            padding: 20px;
            text-align: center;
            color: #999;
        }
        .header-search-empty {
            padding: 20px;
            text-align: center;
            color: #999;
        }
    `;
    document.head.appendChild(style);
    
    // Debounced search function
    function handleSearch() {
        clearTimeout(debounceTimer);
        
        const query = searchInput.value.trim();
        if (query.length < 1) {
            closeDropdown();
            return;
        }
        
        debounceTimer = setTimeout(() => {
            fetchResults(query);
        }, 300);
    }
    
    // Fetch results from API
    function fetchResults(query) {
        if (abortController) abortController.abort();
        abortController = new AbortController();
        
        dropdown.innerHTML = '<div class="header-search-loading">Loading...</div>';
        dropdown.style.display = 'block';
        isDropdownOpen = true;
        
        fetch('/api/search-main?q=' + encodeURIComponent(query), {
            signal: abortController.signal
        })
        .then(response => response.json())
        .then(data => {
            renderResults(data);
        })
        .catch(err => {
            if (err.name !== 'AbortError') {
                dropdown.innerHTML = '<div class="header-search-empty">Error loading results</div>';
            }
        });
    }
    
    // Render results in dropdown
    function renderResults(data) {
        const companies = data.companies || [];
        const categories = data.categories || [];
        const subcategories = data.subcategories || [];
        const locations = data.locations || [];
        
        if (!companies.length && !categories.length && !subcategories.length && !locations.length) {
            dropdown.innerHTML = '<div class="header-search-empty">No results found</div>';
            return;
        }
        
        let html = '';
        
        if (companies.length) {
            html += '<div class="header-search-group">';
            html += '<div class="header-search-group-title">Companies</div>';
            companies.forEach(item => {
                html += `<div class="header-search-item" onclick="window.location.href='/profile/${encodeURIComponent(item.slug)}'">${escapeHtml(item.name)}</div>`;
            });
            html += '</div>';
        }
        
        if (categories.length) {
            html += '<div class="header-search-group">';
            html += '<div class="header-search-group-title">Categories</div>';
            categories.forEach(item => {
                html += `<div class="header-search-item" onclick="window.location.href='/companies/${encodeURIComponent(item.slug)}'">${escapeHtml(item.name)}</div>`;
            });
            html += '</div>';
        }
        
        if (subcategories.length) {
            html += '<div class="header-search-group">';
            html += '<div class="header-search-group-title">Subcategories</div>';
            subcategories.forEach(item => {
                html += `<div class="header-search-item" onclick="window.location.href='/companies/${encodeURIComponent(item.slug)}'">${escapeHtml(item.name)}</div>`;
            });
            html += '</div>';
        }
        
        if (locations.length) {
            html += '<div class="header-search-group">';
            html += '<div class="header-search-group-title">Locations</div>';
            locations.forEach(item => {
                html += `<div class="header-search-item" onclick="window.location.href='/companies/${encodeURIComponent(item.slug)}'">${escapeHtml(item.name)}</div>`;
            });
            html += '</div>';
        }
        
        dropdown.innerHTML = html;
    }
    
    // Close dropdown
    function closeDropdown() {
        dropdown.style.display = 'none';
        isDropdownOpen = false;
    }
    
    // Escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Event listeners
    searchInput.addEventListener('input', handleSearch);
    searchInput.addEventListener('focus', function() {
        if (searchInput.value.trim().length > 0) {
            handleSearch();
        }
    });
    
    // Close on outside click
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
            closeDropdown();
        }
    });
    
    // Close on Escape key
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDropdown();
        }
    });
    
})();
