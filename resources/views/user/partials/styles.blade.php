{{-- resources/views/user/partials/styles.blade.php --}}
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* ============ HERO ============ */
    .up-hero {
        background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 40%, #16213e 100%);
        padding: 40px 0 50px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .up-hero .container {
        position: relative;
        z-index: 2;
    }

    .up-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 12px;
    }

    .up-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #2ecc71;
    }

    .up-title {
        font-size: 34px;
        font-weight: 800;
        margin: 0 0 8px;
        color: #fff;
    }

    .up-subtitle {
        font-size: 15px;
        opacity: 0.6;
        margin: 0;
    }

    .up-shapes {
        position: absolute;
        inset: 0;
        z-index: 1;
        pointer-events: none;
        overflow: hidden;
    }

    .up-shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.05;
    }

    .up-shape-1 {
        top: -100px;
        right: -80px;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, #e74c3c, transparent);
    }

    .up-shape-2 {
        bottom: -110px;
        left: -60px;
        width: 260px;
        height: 260px;
        background: radial-gradient(circle, #f39c12, transparent);
    }

    /* ============ SECTION / SUBNAV ============ */
    .up-section {
        padding: 30px 0 70px;
        background: #f8f9fa;
    }

    .up-subnav {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        background: #0e0e22;
        padding: 8px;
        border-radius: 14px;
        margin-bottom: 24px;
    }

    .up-subnav-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 10px;
        color: #aaa;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        flex: 1 1 auto;
        justify-content: center;
        white-space: nowrap;
    }

    .up-subnav-item:hover {
        background: rgba(255, 255, 255, 0.06);
        color: #fff;
    }

    .up-subnav-item.active {
        background: rgba(231, 76, 60, 0.15);
        color: #e74c3c;
        font-weight: 600;
    }

    /* ============ CARD ============ */
    .up-card {
        background: #fff;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .up-card-pad0 {
        padding: 0;
        overflow: hidden;
    }

    /* ============ PROFILE ============ */
    .up-profile-head {
        display: flex;
        align-items: center;
        gap: 18px;
        padding-bottom: 22px;
        margin-bottom: 22px;
        border-bottom: 1px solid #f0f0f0;
    }

    .up-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .up-profile-name {
        margin: 0 0 6px;
        font-size: 20px;
        font-weight: 700;
        color: #1a1a2e;
    }

    .up-status-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .up-status-badge.active {
        background: #f0fdf4;
        color: #1e8449;
    }

    .up-status-badge.pending {
        background: #fef3c7;
        color: #b45309;
    }

    .up-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .up-info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .up-info-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        font-weight: 600;
    }

    .up-info-value {
        font-size: 15px;
        color: #1a1a2e;
        font-weight: 500;
        word-break: break-word;
    }

    .up-note {
        margin: 24px 0 0;
        padding-top: 18px;
        border-top: 1px solid #f0f0f0;
        font-size: 13px;
        color: #999;
    }

    /* ============ TABLE ============ */
    .up-table-wrap {
        overflow-x: auto;
    }

    .up-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 640px;
    }

    .up-table th {
        text-align: left;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #999;
        font-weight: 700;
        padding: 16px 20px;
        background: #fafafa;
        border-bottom: 1px solid #f0f0f0;
    }

    .up-table td {
        padding: 16px 20px;
        font-size: 14px;
        color: #333;
        border-bottom: 1px solid #f5f5f5;
        vertical-align: middle;
    }

    .up-table tr:last-child td {
        border-bottom: none;
    }

    .up-truncate {
        max-width: 260px;
    }

    .up-pagination {
        padding: 18px 20px;
    }

    /* ============ PILLS ============ */
    .up-pill {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    .up-pill-success {
        background: #f0fdf4;
        color: #1e8449;
    }

    .up-pill-pending {
        background: #fef3c7;
        color: #b45309;
    }

    .up-pill-processing {
        background: rgba(52, 152, 219, 0.12);
        color: #2980b9;
    }

    .up-pill-danger {
        background: #fef2f2;
        color: #c0392b;
    }

    /* ============ STATS ============ */
    .up-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .up-stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 18px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .up-stat-number {
        display: block;
        font-size: 24px;
        font-weight: 800;
        color: #1a1a2e;
    }

    .up-stat-label {
        display: block;
        font-size: 12px;
        color: #888;
        font-weight: 600;
        margin-top: 4px;
        text-transform: uppercase;
    }

    .up-text-success {
        color: #1e8449 !important;
    }

    .up-text-warning {
        color: #b45309 !important;
    }

    .up-text-danger {
        color: #c0392b !important;
    }

    /* ============ TABS ============ */
    .up-tabs {
        display: flex;
        gap: 4px;
        padding: 14px 20px 0;
        border-bottom: 1px solid #f0f0f0;
        overflow-x: auto;
    }

    .up-tab {
        border: none;
        background: transparent;
        padding: 10px 18px;
        font-size: 14px;
        font-weight: 600;
        color: #888;
        cursor: pointer;
        border-radius: 10px 10px 0 0;
        white-space: nowrap;
    }

    .up-tab.active {
        color: #e74c3c;
        background: rgba(231, 76, 60, 0.06);
    }

    .up-tab-panel.up-hidden {
        display: none;
    }

    /* ============ EMPTY ============ */
    .up-empty {
        padding: 50px 20px;
        text-align: center;
        color: #999;
    }

    .up-btn {
        display: inline-block;
        margin-top: 14px;
        padding: 10px 24px;
        border-radius: 50px;
        background: #e74c3c;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
    }

    /* ============ PRODUCTS GRID ============ */
    .up-products-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .up-product-card {
        background: #fff;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .up-product-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 8px;
    }

    .up-product-head h3 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #1a1a2e;
    }

    .up-product-desc {
        font-size: 13px;
        color: #888;
        margin: 0 0 16px;
        line-height: 1.5;
    }

    .up-product-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        padding-top: 14px;
        border-top: 1px solid #f0f0f0;
    }

    .up-product-remark {
        margin: 14px 0 0;
        font-size: 13px;
        color: #666;
        background: #fafafa;
        padding: 10px 14px;
        border-radius: 10px;
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 900px) {
        .up-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .up-products-grid {
            grid-template-columns: 1fr;
        }

        .up-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .up-title {
            font-size: 26px;
        }

        .up-subnav {
            overflow-x: auto;
            flex-wrap: nowrap;
        }

        .up-subnav-item {
            flex: 0 0 auto;
        }

        .up-table {
            min-width: 0;
        }

        /* Card-style table on small screens */
        .up-table thead {
            display: none;
        }

        .up-table,
        .up-table tbody,
        .up-table tr,
        .up-table td {
            display: block;
            width: 100%;
        }

        .up-table tr {
            padding: 14px 16px;
            border-bottom: 8px solid #f8f9fa;
        }

        .up-table td {
            border-bottom: none;
            padding: 6px 0;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .up-table td::before {
            content: attr(data-label);
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 700;
            color: #999;
        }
    }

    @media (max-width: 480px) {
        .up-info-grid {
            grid-template-columns: 1fr;
        }

        .up-stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .up-product-meta {
            grid-template-columns: 1fr;
        }

        .up-profile-head {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
