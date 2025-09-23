@extends('layouts.public-booking')

@section('title', 'Booking #' . $booking->booking_code . ' - Rumah BUMN Telkom Pekalongan')
@section('description', 'Detail booking ruangan ' . $booking->room->name)
/* Reset and Base Styles */
* {
    box-sizing: border-box;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.section {
    padding: 2rem 0;
}

/* Page Header Styles */
.page-header-section {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: white;
    padding: 2rem 0;
    position: relative;
    overflow: hidden;
}

.page-header-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><circle cx="36" cy="24" r="6"/></g></svg>') repeat;
    opacity: 0.3;
}

.page-header-content {
    position: relative;
    z-index: 1;
}

/* Breadcrumb Styles */
.breadcrumb-nav {
    margin-bottom: 2rem;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    color: #e2e8f0;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.breadcrumb-item:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    text-decoration: none;
}

.breadcrumb-separator {
    color: #64748b;
    opacity: 0.5;
}

.breadcrumb-current {
    color: #fbbf24;
    font-weight: 600;
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
    background: rgba(251, 191, 36, 0.1);
    border-radius: 6px;
    border: 1px solid rgba(251, 191, 36, 0.2);
}

/* Header Content Styles */
.header-content {
    text-align: left;
}

.header-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(99, 102, 241, 0.15);
    border: 1px solid rgba(99, 102, 241, 0.3);
    color: #a5b4fc;
    border-radius: 25px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.header-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: white;
    line-height: 1.2;
}

.header-description {
    font-size: 1.125rem;
    color: #cbd5e1;
    margin: 0;
    font-weight: 400;
}

/* Enhanced Booking Details Styles */
.booking-details-section {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 80vh;
    padding: 2rem 0;
}

.booking-details-layout {
    display: grid;
    grid-template-columns: 400px 1fr;
    gap: 2.5rem;
    max-width: 1400px;
    margin: 0 auto;
    align-items: start;
}

/* Alert Styles */
.alert {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.alert-success {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    border: 1px solid #6ee7b7;
    color: #065f46;
}

/* Status Card Styles */
.status-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12), 0 8px 25px -8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    position: sticky;
    top: 2rem;
    height: fit-content;
    transition: all 0.3s ease;
}

.status-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 12px 30px -8px rgba(0, 0, 0, 0.1);
}

.status-card.pending {
    border-left: 4px solid #f59e0b;
}

.status-card.confirmed {
    border-left: 4px solid #10b981;
}

.status-card.cancelled {
    border-left: 4px solid #ef4444;
}

.status-card.completed {
    border-left: 4px solid #6366f1;
}

.status-header {
    padding: 2.5rem;
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: white;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    position: relative;
    overflow: hidden;
}

.status-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.03"><circle cx="36" cy="24" r="6"/></g></svg>') repeat;
    opacity: 0.5;
}

.status-icon-wrapper {
    position: relative;
}

.status-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.status-icon.pending {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    box-shadow: 0 0 20px rgba(251, 191, 36, 0.4);
}

.status-icon.confirmed {
    background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
    box-shadow: 0 0 20px rgba(52, 211, 153, 0.4);
}

.status-icon.cancelled {
    background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
    box-shadow: 0 0 20px rgba(248, 113, 113, 0.4);
}

.status-icon.completed {
    background: linear-gradient(135deg, #818cf8 0%, #6366f1 100%);
    box-shadow: 0 0 20px rgba(129, 140, 248, 0.4);
}

.status-info {
    flex: 1;
    position: relative;
    z-index: 1;
}

.status-title {
    font-size: 1.75rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
    letter-spacing: -0.025em;
}

.booking-code {
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    opacity: 0.8;
    margin-bottom: 1rem;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    display: inline-block;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.status-badge {
    display: inline-block;
    padding: 0.375rem 0.875rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-badge.pending {
    background: rgba(251, 191, 36, 0.15);
    color: #f59e0b;
}

.status-badge.confirmed {
    background: rgba(16, 185, 129, 0.15);
    color: #10b981;
}

.status-badge.cancelled {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
}

.status-badge.completed {
    background: rgba(99, 102, 241, 0.15);
    color: #6366f1;
}

.status-message {
    padding: 2.5rem;
    border-top: 1px solid #e2e8f0;
    background: linear-gradient(135deg, #fafbfc 0%, #f8fafc 100%);
}

.message-content h4 {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.message-content p {
    color: #64748b;
    margin-bottom: 1.5rem;
    line-height: 1.7;
    font-size: 1rem;
}

.confirm-time, .cancel-time {
    color: #94a3b8;
    font-size: 0.875rem;
    font-style: italic;
}

.next-steps {
    margin-top: 1.5rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.next-steps h5 {
    font-size: 0.875rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.75rem;
}

.next-steps ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.next-steps li {
    padding: 0.375rem 0;
    color: #64748b;
    position: relative;
    padding-left: 1.5rem;
}

.next-steps li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #10b981;
    font-weight: bold;
}

.status-actions {
    padding: 1.5rem 2rem;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

.btn-cancel {
    width: 100%;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 15px rgba(239, 68, 68, 0.3);
}

/* Booking Info Card Styles */
.booking-info-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12), 0 8px 25px -8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s ease;
}

.booking-info-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 12px 30px -8px rgba(0, 0, 0, 0.1);
}

.card-header {
    padding: 2rem 2rem 1rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid #e2e8f0;
}

.card-header h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

.info-section {
    padding: 2.5rem;
    border-bottom: 1px solid #f1f5f9;
    position: relative;
}

.info-section:last-child {
    border-bottom: none;
}

.info-section::before {
    content: '';
    position: absolute;
    left: 2.5rem;
    right: 2.5rem;
    bottom: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, #e2e8f0 50%, transparent 100%);
}

.info-section:last-child::before {
    display: none;
}

.section-header {
    margin-bottom: 2rem;
}

.section-header h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
}

/* Room Info Styles */
.room-card {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.room-image {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.room-details h5 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem;
}

.room-specs {
    margin-bottom: 1rem;
}

.spec-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.375rem 0.875rem;
    background: white;
    border-radius: 20px;
    color: #64748b;
    font-size: 0.875rem;
    font-weight: 500;
    border: 1px solid #e2e8f0;
}

.room-description {
    color: #64748b;
    font-size: 0.875rem;
    line-height: 1.5;
    margin: 0;
}

/* Time Grid Styles */
.time-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.time-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.75rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.time-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px -8px rgba(0, 0, 0, 0.1);
    border-color: #c7d2fe;
}

.time-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #6366f1, #8b5cf6);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.time-item:hover::before {
    opacity: 1;
}

.time-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.time-details label {
    display: block;
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.25rem;
    font-weight: 500;
}

.time-details .highlight {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
}

/* Contact Grid Styles */
.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.75rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.contact-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px -8px rgba(0, 0, 0, 0.1);
    border-color: #6ee7b7;
}

.contact-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #10b981, #34d399);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.contact-item:hover::before {
    opacity: 1;
}

.contact-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.contact-details label {
    display: block;
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.25rem;
    font-weight: 500;
}

.contact-details span {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
}

/* Event Content Styles */
.event-content {
    space-y: 1.5rem;
}

.event-item {
    display: flex;
    gap: 1rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.5rem;
}

.event-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.event-details {
    flex: 1;
}

.event-details label {
    display: block;
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.event-details p {
    color: #1e293b;
    font-size: 1rem;
    line-height: 1.6;
    margin: 0;
}

/* Action Buttons Styles */
.booking-actions {
    margin-top: 4rem;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
}

.action-buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}

.btn-download, .btn-new-booking {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 2rem 2.5rem;
    border-radius: 20px;
    text-decoration: none;
    color: white;
    font-weight: 700;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border: none;
    cursor: pointer;
    box-shadow: 0 10px 30px -8px rgba(0, 0, 0, 0.15);
}

.btn-download::before, .btn-new-booking::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.6s ease;
}

.btn-download:hover::before, .btn-new-booking:hover::before {
    left: 100%;
}

.btn-download {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.3);
}

.btn-new-booking {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.3);
}

.btn-download:hover, .btn-new-booking:hover {
    transform: translateY(-3px) scale(1.02);
    color: white;
    text-decoration: none;
}

.btn-download:hover {
    box-shadow: 0 20px 50px -8px rgba(16, 185, 129, 0.4);
}

.btn-new-booking:hover {
    box-shadow: 0 20px 50px -8px rgba(99, 102, 241, 0.4);
}

.btn-icon {
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.btn-content {
    flex: 1;
}

.btn-title {
    display: block;
    font-size: 1.125rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.btn-subtitle {
    display: block;
    font-size: 0.875rem;
    opacity: 0.8;
}

.btn-arrow {
    opacity: 0.7;
    transition: transform 0.3s ease;
}

.btn-download:hover .btn-arrow,
.btn-new-booking:hover .btn-arrow {
    transform: translateX(4px);
}

/* Quick Info Styles */
.quick-info {
    margin-top: 2rem;
}

.info-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
}

.info-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.info-content h4 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.info-content p {
    color: #64748b;
    margin-bottom: 1rem;
}

.contact-links {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.contact-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6366f1;
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f1f5f9;
    transition: color 0.3s ease;
}

.contact-link:hover {
    color: #4f46e5;
    text-decoration: none;
}

.contact-link:last-child {
    border-bottom: none;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .booking-details-layout {
        grid-template-columns: 350px 1fr;
        gap: 2rem;
    }
    
    .status-header {
        padding: 2rem;
        gap: 1rem;
    }
    
    .status-message {
        padding: 2rem;
    }
    
    .info-section {
        padding: 2rem;
    }
    
    .action-buttons {
        gap: 1.5rem;
    }
    
    .btn-download, .btn-new-booking {
        padding: 1.5rem 2rem;
        gap: 1rem;
    }
    
    .btn-icon {
        width: 48px;
        height: 48px;
    }
}

@media (max-width: 768px) {
    .page-header-section {
        padding: 1.5rem 0;
    }
    
    .header-content h1 {
        font-size: 2rem;
    }
    
    .booking-details-layout {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        max-width: 100%;
    }
    
    .status-card {
        position: static;
        margin-bottom: 1.5rem;
    }
    
    .status-header {
        padding: 1.5rem;
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .status-message {
        padding: 1.5rem;
    }
    
    .info-section {
        padding: 1.5rem;
    }
    
    .action-buttons {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .time-grid,
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .room-card {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .info-card {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .breadcrumb {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-download, .btn-new-booking {
        padding: 1.25rem 1.5rem;
        border-radius: 16px;
    }
    
    .btn-icon {
        width: 44px;
        height: 44px;
    }
    
    .container {
        padding: 0 1rem;
    }
}

@media (max-width: 480px) {
    .header-content h1 {
        font-size: 1.75rem;
    }
    
    .status-title {
        font-size: 1.5rem;
    }
    
    .btn-download, .btn-new-booking {
        padding: 1rem 1.25rem;
        gap: 0.75rem;
        font-size: 0.9rem;
    }
    
    .btn-title {
        font-size: 1rem;
    }
    
    .btn-subtitle {
        font-size: 0.8rem;
    }
    
    .time-item, .contact-item, .event-item {
        padding: 1rem;
        gap: 0.75rem;
    }
    
    .time-icon, .contact-icon, .event-icon {
        width: 40px;
        height: 40px;
    }
}
</style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header-section">
        <div class="container">
            <div class="page-header-content">
                <nav class="breadcrumb-nav">
                    <div class="breadcrumb">
                        <a href="{{ url('/') }}" class="breadcrumb-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                            Beranda
                        </a>
                        <svg class="breadcrumb-separator" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                        </svg>
                        <a href="{{ route('booking.index') }}" class="breadcrumb-item">Booking Ruangan</a>
                        <svg class="breadcrumb-separator" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                        </svg>
                        <span class="breadcrumb-current">{{ $booking->booking_code }}</span>
                    </div>
                </nav>
                
                <div class="header-content">
                    <div class="header-badge">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M19,19H5V8H19V19M19,6H5V5H19V6Z"/>
                        </svg>
                        Detail Booking
                    </div>
                    <h1>Booking #{{ $booking->booking_code }}</h1>
                    <p class="header-description">{{ $booking->room->name }} • {{ $booking->formatted_date }} • {{ $booking->formatted_time }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Details Section -->
    <section class="booking-details-section section">
        <div class="container">
            <!-- Success Alert if needed -->
            @if(session('success'))
                <div class="alert alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="booking-details-layout">
                <!-- Booking Status Card -->
                <div class="status-card {{ $booking->status }}">
                    <div class="status-header">
                        <div class="status-icon-wrapper">
                            <div class="status-icon {{ $booking->status }}">
                                @if($booking->status === 'pending')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z"/>
                                    </svg>
                                @elseif($booking->status === 'confirmed')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                @elseif($booking->status === 'cancelled')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z"/>
                                    </svg>
                                @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="status-info">
                            <h3 class="status-title">{{ $booking->status_label }}</h3>
                            <p class="booking-code">{{ $booking->booking_code }}</p>
                            <span class="status-badge {{ $booking->status }}">
                                @if($booking->status === 'pending') MENUNGGU KONFIRMASI
                                @elseif($booking->status === 'confirmed') DIKONFIRMASI
                                @elseif($booking->status === 'cancelled') DIBATALKAN
                                @else SELESAI
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <div class="status-message {{ $booking->status }}">
                        @if($booking->status === 'pending')
                            <div class="message-content">
                                <h4><i class="icon-pending"></i> Menunggu Konfirmasi</h4>
                                <p>Booking Anda sedang direview oleh admin. Kami akan mengkonfirmasi dalam 24 jam.</p>
                                <div class="next-steps">
                                    <h5>Langkah selanjutnya:</h5>
                                    <ul>
                                        <li>Tunggu email/SMS konfirmasi dari admin</li>
                                        <li>Simpan bukti booking ini sebagai PDF</li>
                                        <li>Siapkan dokumen yang diperlukan</li>
                                    </ul>
                                </div>
                            </div>
                        @elseif($booking->status === 'confirmed')
                            <div class="message-content">
                                <h4><i class="icon-confirmed"></i> Booking Dikonfirmasi!</h4>
                                <p>Booking Anda telah dikonfirmasi. Silakan datang sesuai waktu yang dijadwalkan.</p>
                                @if($booking->confirmed_at)
                                    <small class="confirm-time">Dikonfirmasi pada: {{ $booking->confirmed_at->format('d M Y H:i') }}</small>
                                @endif
                                <div class="next-steps">
                                    <h5>Yang perlu Anda bawa:</h5>
                                    <ul>
                                        <li>Bukti booking (PDF atau screenshot)</li>
                                        <li>Kartu identitas yang valid</li>
                                        <li>Datang 10 menit sebelum waktu booking</li>
                                    </ul>
                                </div>
                            </div>
                        @elseif($booking->status === 'cancelled')
                            <div class="message-content">
                                <h4><i class="icon-cancelled"></i> Booking Dibatalkan</h4>
                                <p>Booking ini telah dibatalkan.</p>
                                @if($booking->cancelled_at)
                                    <small class="cancel-time">Dibatalkan pada: {{ $booking->cancelled_at->format('d M Y H:i') }}</small>
                                @endif
                                <div class="next-steps">
                                    <h5>Anda dapat:</h5>
                                    <ul>
                                        <li>Membuat booking baru dengan waktu berbeda</li>
                                        <li>Menghubungi admin untuk informasi lebih lanjut</li>
                                    </ul>
                                </div>
                            </div>
                        @elseif($booking->status === 'completed')
                            <div class="message-content">
                                <h4><i class="icon-completed"></i> Booking Selesai</h4>
                                <p>Terima kasih telah menggunakan fasilitas kami!</p>
                                <div class="next-steps">
                                    <h5>Feedback:</h5>
                                    <p>Kami sangat menghargai feedback Anda untuk meningkatkan layanan kami.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    @if($booking->canBeCancelled())
                        <div class="status-actions">
                            <form action="{{ route('booking.cancel', $booking) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-cancel">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                    </svg>
                                    Batalkan Booking
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Booking Information Card -->
                <div class="booking-info-card">
                    <div class="card-header">
                        <h3>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14,6V4H5V21H7V14H12V16H19V8H14V6M12,4H19A2,2 0 0,1 21,6V16A2,2 0 0,1 19,18H14V21A2,2 0 0,1 12,23H5A2,2 0 0,1 3,21V4A2,2 0 0,1 5,2H12A2,2 0 0,1 14,4Z"/>
                            </svg>
                            Informasi Booking
                        </h3>
                    </div>
                    
                    <div class="info-section room-info">
                        <div class="section-header">
                            <h4>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,11A1,1 0 0,0 13,12A1,1 0 0,0 12,13A1,1 0 0,0 11,12A1,1 0 0,0 12,11M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2Z"/>
                                </svg>
                                Detail Ruangan
                            </h4>
                        </div>
                        <div class="room-card">
                            <div class="room-image">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,11A1,1 0 0,0 13,12A1,1 0 0,0 12,13A1,1 0 0,0 11,12A1,1 0 0,0 12,11M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2Z"/>
                                </svg>
                            </div>
                            <div class="room-details">
                                <h5>{{ $booking->room->name }}</h5>
                                <div class="room-specs">
                                    <span class="spec-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M16,4C18.11,4 19.8,5.69 19.8,7.8C19.8,9.91 18.11,11.6 16,11.6C13.89,11.6 12.2,9.91 12.2,7.8C12.2,5.69 13.89,4 16,4M16,13.4C18.67,13.4 24,14.73 24,17.4V20H8V17.4C8,14.73 13.33,13.4 16,13.4Z"/>
                                        </svg>
                                        {{ $booking->room->capacity }} orang
                                    </span>
                                </div>
                                @if($booking->room->description)
                                    <p class="room-description">{{ $booking->room->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-section time-info">
                        <div class="section-header">
                            <h4>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                                </svg>
                                Waktu & Tanggal
                            </h4>
                        </div>
                        <div class="time-grid">
                            <div class="time-item">
                                <div class="time-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M19,19H5V8H19V19M19,6H5V5H19V6Z"/>
                                    </svg>
                                </div>
                                <div class="time-details">
                                    <label>Tanggal</label>
                                    <span class="highlight">{{ $booking->formatted_date }}</span>
                                </div>
                            </div>
                            <div class="time-item">
                                <div class="time-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                                    </svg>
                                </div>
                                <div class="time-details">
                                    <label>Waktu</label>
                                    <span class="highlight">{{ $booking->formatted_time }}</span>
                                </div>
                            </div>
                            <div class="time-item">
                                <div class="time-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                                    </svg>
                                </div>
                                <div class="time-details">
                                    <label>Durasi</label>
                                    <span class="highlight">{{ $booking->duration_hours }} jam</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-section contact-info">
                        <div class="section-header">
                            <h4>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                </svg>
                                Informasi Kontak
                            </h4>
                        </div>
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                    </svg>
                                </div>
                                <div class="contact-details">
                                    <label>Nama Lengkap</label>
                                    <span>{{ $booking->contact_name }}</span>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/>
                                    </svg>
                                </div>
                                <div class="contact-details">
                                    <label>No. Telepon</label>
                                    <span>{{ $booking->contact_phone }}</span>
                                </div>
                            </div>
                            @if($booking->contact_email)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
                                        </svg>
                                    </div>
                                    <div class="contact-details">
                                        <label>Email</label>
                                        <span>{{ $booking->contact_email }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($booking->organization)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12,7V3H2V21H22V7H12M6,19H4V17H6V19M6,15H4V13H6V15M6,11H4V9H6V11M6,7H4V5H6V7M10,19H8V17H10V19M10,15H8V13H10V15M10,11H8V9H10V11M10,7H8V5H10V7M20,19H12V17H14V15H12V13H14V11H12V9H20V19M18,11H16V13H18V11M18,15H16V17H18V15Z"/>
                                        </svg>
                                    </div>
                                    <div class="contact-details">
                                        <label>Organisasi</label>
                                        <span>{{ $booking->organization }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-section event-info">
                        <div class="section-header">
                            <h4>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13,9H18.5L13,3.5V9M6,2H14L20,8V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V4C4,2.89 4.89,2 6,2M15,18V16H6V18H15M18,14V12H6V14H18Z"/>
                                </svg>
                                Detail Acara
                            </h4>
                        </div>
                        <div class="event-content">
                            <div class="event-item">
                                <div class="event-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9,10V12H7V10H9M13,10V12H11V10H13M17,10V12H15V10H17M19,3A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5A2,2 0 0,1 5,3H6V1H8V3H16V1H18V3H19M19,19V8H5V19H19M9,14V16H7V14H9M13,14V16H11V14H13M17,14V16H15V14H17Z"/>
                                    </svg>
                                </div>
                                <div class="event-details">
                                    <label>Tujuan Penggunaan</label>
                                    <p>{{ $booking->purpose }}</p>
                                </div>
                            </div>
                            @if($booking->notes)
                                <div class="event-item">
                                    <div class="event-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M14,10H19.5L14,4.5V10M5,3H15L21,9V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3M9,12H16V14H9V12M9,16H13V18H9V16Z"/>
                                        </svg>
                                    </div>
                                    <div class="event-details">
                                        <label>Catatan Tambahan</label>
                                        <p>{{ $booking->notes }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="booking-actions">
                <div class="action-buttons">
                    <a href="{{ route('booking.download-pdf', $booking) }}" class="btn-download" target="_blank">
                        <div class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                        </div>
                        <div class="btn-content">
                            <span class="btn-title">Download Bukti PDF</span>
                            <small class="btn-subtitle">Simpan sebagai bukti booking</small>
                        </div>
                        <div class="btn-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,13H13V19H11V13H5L12,6L19,13Z"/>
                            </svg>
                        </div>
                    </a>
                    
                    <a href="{{ route('booking.index') }}" class="btn-new-booking">
                        <div class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                            </svg>
                        </div>
                        <div class="btn-content">
                            <span class="btn-title">Booking Ruangan Lagi</span>
                            <small class="btn-subtitle">Buat booking baru</small>
                        </div>
                        <div class="btn-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"/>
                            </svg>
                        </div>
                    </a>
                </div>
                
                <!-- Quick Info -->
                <div class="quick-info">
                    <div class="info-card">
                        <div class="info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z"/>
                            </svg>
                        </div>
                        <div class="info-content">
                            <h4>Perlu Bantuan?</h4>
                            <p>Hubungi admin melalui:</p>
                            <div class="contact-links">
                                <a href="tel:+628123456789" class="contact-link">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/>
                                    </svg>
                                    (0285) 123-456
                                </a>
                                <a href="mailto:admin@rumahbumn.id" class="contact-link">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
                                    </svg>
                                    admin@rumahbumn.id
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection