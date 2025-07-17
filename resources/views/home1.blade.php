@extends('layouts.home-master')

@section('content')
<style>
    <style>
.filter-section h2 {
  background-color: #ece4fa;
  color: #000;
  font-size: 18px;
  font-weight: 700;
  font-family: "Epilogue", sans-serif;
  padding: 7px 11px;
}

.filters select {
  font-size: 14px;
  font-weight: 400;
  font-family: "Inter", sans-serif;
  colo: #23262a;

}

select {
  -webkit-appearance: auto !important;
  -moz-appearance: auto !important;
  text-indent: 1px;

}

.company-description-box {
  border-right: 1px solid #ccc;
}

.btn-wrap {
  width: 100%;
  text-align: right
}

.company-details h3 {
  font-size: 24px !important;
  font-weight: 700;
  color: #171a1f !important;
  text-transform: capitalize;
  font-family: "Epilogue", sans-serif;
}

.btn-wrap button:hover {
  background-color: #dee1e6;
  color: #000;
}

.rate {
  background: url(https://theytrust-us.developmentserver.info/img/star.png) no-repeat left center;
}

.dollar {
  background: url(https://theytrust-us.developmentserver.info/img/dollar.png) no-repeat left center;

}


.indust {
  background: url(https://theytrust-us.developmentserver.info/img/zig.png) no-repeat left center;

}




.btn-wrap button {
  background-color: #dee1e6;
  color: #000;
}

.smallselect {
  height: 35px;
  width: 70px;
  background-size: 18px;
  border: 1px solid #ccc;
  border-radius: 3px;
  padding: 0 0px 0 18px;
  background-position-x: 3px;
  background-color: #fff;
}

.bigselect {
  height: 35px;
  width: 188px;
  border: 1px solid #ccc;
  border-radius: 3px;
  padding: 0 0px 0 18px;
  text-indent: 4px;
  font-size: 14px;
  font-weight: 400;
  font-family: "Inter", sans-serif;
  color: #23262a;

}

.bigselect::placeholder {
  color: #23262a;
}

.logobox {
  display: block;
}


.logobox .buttons {

  display: grid;

}

.write-box {
  text-align: right;
  padding-right: 41px;
}

.service-box {
  display: flex;
  flex-flow: wrap;
}

.write-review-link {
  margin-top: 12px;
  font-size: 14px;
  font-weight: 600;
  margin-left: 12px;
  color: #379ae6 !important;
  text-decoration: underline;
  display: block;
}

.company-description {
  margin-bottom: 40px;
  font-size: 14px;
  font-weight: 400;
  font-family: "Inter", sans-serif;
}

.location-suggestions {
  position: relative;
}

.searchlocation {
  position: relative;
}

.searchlocation ul {
  margin: 0;
  padding: 0;
}

.searchlocation ul li {
  padding: 10px;
  font-size: 14px;
  font-weight: 400;
  font-family: "Inter", sans-serif;
  color: #23262a;

}

@media (max-width: 767px) {
  .searchlocation {
    position: absolute;
    width: 65%;
    border: 0;
  }

  .company-header {
    display: flex;
    gap: 20px;
    flex-direction: column;
  }

  .company-description-box {
    border: 0;
  }

  .company-details {
    border: 0 !important;
  }

  .company-description {
    margin-bottom: 0;
  }

  .smallselect {
    padding: 0;
    width: 100%;

    margin-top: 17px;
  }

  .bigselect {
    padding: 0;
    width: 100%;

    margin-top: 17px;
  }



  .logobox {
    display: block;
    text-align: center;
  }

  .service-box {
    display: flex;
    flex-direction: column;
  }
}

.loader-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  /* Semi-transparent background */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.loader {
  width: 50px;
  height: 50px;
  border: 5px solid #f3f3f3;
  /* Light grey */
  border-top: 5px solid #3498db;
  /* Blue */
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

</style>

<style>
    .category-page {
      padding: 20px;
      font-family: Arial, sans-serif;
    }
    
    .breadcrumb {
      font-size: 14px;
      margin-bottom: 20px;
      color: #555;
    }
    
    .breadcrumb a {
      color: #007bff;
      text-decoration: none;
    }
    
    .breadcrumb a:hover {
      text-decoration: underline;
    }
    
    h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    
    p {
      font-size: 16px;
      color: #333;
    }
    
    .company-details p a {
      color: #379ae6;
      text-decoration: none;
    }
    
    .company-details p a:hover {
      text-decoration: underline;
    }
    
    .filter-section {
      margin-top: 20px;
      background-color: #f9f9f9;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    
    .filters {
      display: flex;
      flex-wrap: wrap;
      /* gap: 10px; */
      justify-content: space-between;
      align-items: center;
    }
    
    
    .filters button {
      padding: 10px 15px;
      font-size: 14px;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    .filters button:hover {
      background-color: #007bff;
      color: #000;
    }
    
    
    .location-suggestions {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 1px solid #ddd;
      border-radius: 5px;
      max-height: 200px;
      overflow-y: auto;
      z-index: 10;
    }
    
    .location-suggestions li {
      padding: 10px;
      cursor: pointer;
    }
    
    .location-suggestions li:hover {
      background-color: #f1f1f1;
    }
    
    .result-card {
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 10px;
      border-radius: 5px;
    }
    
    .company-header {
      display: flex;
      gap: 20px;
    }
    
    .company-logo {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }
    
    .company-details .company-description {
      border-top: 1px solid #ccc;
      padding-top: 18px;
      margin-top: 20px;
    }
    
    .company-details p {
      font-size: 12px;
      font-weight: 400;
      font-family: "Inter", sans-serif;
      padding-left: 28px;
    }
    
    .company-details h3 {
      padding-left: 28px;
    }
    
    .company-details h4 {
      padding-left: 28px;
      font-size: 16px;
      font-weight: 700;
      font-family: "Epilogue", sans-serif;
      border-top: 1px solid #ccc;
      padding-top: 34px;
    
    }
    
    .company-details .service-line {
      padding-left: 28px;
    }
    
    .company-details {
      flex: 1;
      border-left: 1px solid #ccc;
    
    }
    
    .company-description,
    .company-full-description {
    
      text-overflow: ellipsis;
    }
    
    .company-full-description.expanded {
      max-height: none;
    }
    
    .company-service-lines {
      margin-top: 20px;
    }
    
    .service-line {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .service-line canvas {
      border-radius: 50%;
    }
    
    .service-line-category {
      font-size: 14px;
    }
    
    .company-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 20px;
    }
    
    .meta-item {
      display: flex;
      margin: auto;
      width: 100%;
    }
    
    .meta-title {
      color: #00bdd6;
      background-color: #ebfdff;
      border-color: #00bdd6 !important;
      border-radius: 5px;
      padding: 3px 21px 3px 14px;
      font-size: 14px;
      margin-right: 5px;
      font-weight: 400 !important;
      border: 0;
      border-radius: 18px;
      font-family: "Inter", sans-serif;
      vertical-align: middle;
      display: flex;
      align-items: center;
    
    }
    
    .meta-title {
      font-weight: bold;
    }
    
    .meta-value {
      color: #424448;
      font-weight: 400;
      font-size: 14px;
      font-family: "Inter", sans-serif;
    }
    
    .buttons {
      margin-top: 10px;
      display: flex;
      gap: 10px;
    }
    
    .company-details .buttons {
      padding-left: 28px;
    }
    
    .write-box p span {
      font-size: 14px;
      font-weight: 700;
      font-family: "Epilogue", sans-serif;
    }
    
    .write-box p a {
      font-size: 14px;
      font-weight: 400;
      font-family: "Inter", sans-serif;
    }
    
    .view-profile-btn:hover,
    .request-quote-btn:hover {
      color: #000 !important;
      text-decoration: none !important;
    }
    
    .view-profile-btn,
    .request-quote-btn {
      padding: 6px 15px;
      font-size: 14px;
      font-weight: 400;
      font-family: "Inter", sans-serif;
      color: #fff;
      background-color: #00bdd6;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
    }
    
    .view-profile-btn:hover,
    .request-quote-btn:hover {
      background-color: #00bdd6;
    }
    
    button {
      margin-top: 10px;
      padding: 10px 15px;
      background-color: #00bdd6;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    button:hover {
      background-color: #00bdd6;
      color: #000;
    }
    
    .breadcrumb a {
      color: #00bdd6 !important;
    }
    </style>
    <div id="app">
        <listing-component
            :categories="{{ json_encode($categories) }}"
            :budgets="{{ json_encode($budgets) }}"
            :rates="{{ json_encode($rates) }}"
            :industries="{{ json_encode($industries) }}"
        ></listing-component>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
