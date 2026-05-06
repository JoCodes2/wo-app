import LandingService from "../services/landing.service.js";

$(document).ready(function () {
    const landing = new LandingService();

    let filterParams = {
        search: '',
        min_price: '',
        max_price: '',
        sort: 'rating',
        page: 1
    };

    const initPage = async () => {
        await landing.applyFilter(filterParams);
    };

    initPage();

    const resetAllFilters = () => {
        filterParams = {
            search: '',
            min_price: '',
            max_price: '',
            sort: 'rating',
            page: 1
        };

        $('#searchWo').val('');
        $('#minPrice').val('');
        $('#maxPrice').val('');
        $('#sortSelect').val('rating');

        landing.applyFilter(filterParams);
    };

    $(document).on('click', '#resetFilter, #btnResetEmpty', function (e) {
        e.preventDefault();
        resetAllFilters();
    });

    $(document).on('click', '.page-btn, #prevPage, #nextPage', function () {
        const page = $(this).data('page');
        if (page) {
            filterParams.page = page;
            landing.applyFilter(filterParams);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    $('#applyFilter').on('click', function () {
        filterParams.page = 1;
        filterParams.min_price = $('#minPrice').val();
        filterParams.max_price = $('#maxPrice').val();
        landing.applyFilter(filterParams);
    });

    $('#sortSelect').on('change', function () {
        filterParams.page = 1;
        filterParams.sort = $(this).val();
        landing.applyFilter(filterParams);
    });

    let searchTimer;
    $('#searchWo').on('input', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            filterParams.page = 1;
            filterParams.search = $(this).val();
            landing.applyFilter(filterParams);
        }, 500);
    });
});
