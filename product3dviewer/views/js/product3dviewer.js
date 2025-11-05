/**
 * Product 3D Viewer JavaScript
 *
 * @author    Claude AI
 * @copyright 2025
 * @license   AFL - Academic Free License (AFL 3.0)
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all model viewers
    initModelViewers();

    // Initialize single product viewer controls if present
    initSingleProductControls();

    // Prevent form submission when interacting with 3D viewer
    preventFormSubmission();
});

/**
 * Initialize all model viewers with loading indicators and error handling
 */
function initModelViewers() {
    const modelViewers = document.querySelectorAll('model-viewer');

    modelViewers.forEach(function(viewer) {
        // Show loading progress
        viewer.addEventListener('progress', function(event) {
            const progressBar = viewer.querySelector('.progress-bar');
            const updateBar = viewer.querySelector('.update-bar');

            if (progressBar && updateBar) {
                progressBar.classList.remove('hide');
                const progress = event.detail.totalProgress;
                updateBar.style.width = (progress * 100) + '%';
            }
        });

        // Hide progress bar when model is loaded
        viewer.addEventListener('load', function() {
            const progressBar = viewer.querySelector('.progress-bar');
            if (progressBar) {
                setTimeout(function() {
                    progressBar.classList.add('hide');
                }, 500);
            }

            // Add loaded class for animations
            viewer.classList.add('loaded');

            // Console log for debugging
            console.log('3D Model loaded successfully:', viewer.getAttribute('src'));
        });

        // Handle errors
        viewer.addEventListener('error', function(event) {
            console.error('Error loading 3D model:', event);

            // Hide progress bar
            const progressBar = viewer.querySelector('.progress-bar');
            if (progressBar) {
                progressBar.classList.add('hide');
            }

            // Show error message (you can customize this)
            showErrorMessage(viewer, 'Failed to load 3D model. Please check the file path.');
        });

        // Handle camera change events
        viewer.addEventListener('camera-change', function() {
            // You can track camera changes for analytics or other purposes
            // console.log('Camera position changed');
        });
    });
}

/**
 * Initialize controls for single product viewer
 */
function initSingleProductControls() {
    const singleViewer = document.querySelector('.product3d-model-single');

    if (!singleViewer) {
        return;
    }

    // Rotate toggle button
    const rotateToggle = document.getElementById('rotate-toggle');
    if (rotateToggle) {
        let isRotating = singleViewer.hasAttribute('auto-rotate');

        rotateToggle.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();

            isRotating = !isRotating;

            if (isRotating) {
                singleViewer.setAttribute('auto-rotate', '');
                rotateToggle.classList.add('active');
            } else {
                singleViewer.removeAttribute('auto-rotate');
                rotateToggle.classList.remove('active');
            }
        });

        // Set initial state
        if (isRotating) {
            rotateToggle.classList.add('active');
        }
    }

    // Reset camera button
    const resetCamera = document.getElementById('reset-camera');
    if (resetCamera) {
        resetCamera.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();

            // Reset camera to default orbit
            singleViewer.cameraOrbit = '45deg 55deg 2.5m';
            singleViewer.fieldOfView = 'auto';

            // Add animation feedback
            resetCamera.style.transform = 'scale(0.9)';
            setTimeout(function() {
                resetCamera.style.transform = '';
            }, 150);
        });
    }

    // Handle AR button availability
    const arButton = singleViewer.querySelector('.ar-button');
    if (arButton) {
        singleViewer.addEventListener('ar-status', function(event) {
            if (event.detail.status === 'not-presenting') {
                arButton.style.display = 'block';
            }
        });
    }
}

/**
 * Show error message on viewer
 * @param {HTMLElement} viewer - The model viewer element
 * @param {string} message - Error message to display
 */
function showErrorMessage(viewer, message) {
    const wrapper = viewer.closest('.product3d-viewer-wrapper');
    if (!wrapper) {
        return;
    }

    // Check if error message already exists
    let errorDiv = wrapper.querySelector('.product3d-error');

    if (!errorDiv) {
        errorDiv = document.createElement('div');
        errorDiv.className = 'product3d-error';
        errorDiv.style.cssText = `
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 59, 48, 0.95);
            color: white;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            z-index: 10;
            max-width: 80%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        `;
        wrapper.appendChild(errorDiv);
    }

    errorDiv.innerHTML = `
        <i class="material-icons" style="font-size: 48px; margin-bottom: 10px;">error_outline</i>
        <p style="margin: 0; font-size: 14px;">${message}</p>
    `;
}

/**
 * Lazy load 3D models when they come into viewport
 */
if ('IntersectionObserver' in window) {
    const observerOptions = {
        root: null,
        rootMargin: '50px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const viewer = entry.target;

                // If the model has a data-src attribute, move it to src to trigger loading
                const dataSrc = viewer.getAttribute('data-src');
                if (dataSrc && !viewer.getAttribute('src')) {
                    viewer.setAttribute('src', dataSrc);
                    viewer.removeAttribute('data-src');
                }

                // Stop observing this viewer
                observer.unobserve(viewer);
            }
        });
    }, observerOptions);

    // Observe all model viewers with data-src attribute
    document.querySelectorAll('model-viewer[data-src]').forEach(function(viewer) {
        observer.observe(viewer);
    });
}

/**
 * Prevent form submission when interacting with 3D viewer
 * This is crucial when the viewer is inside a product form
 */
function preventFormSubmission() {
    // Get all viewer wrappers
    const viewerWrappers = document.querySelectorAll('.product3d-viewer-wrapper, .product3d-single-viewer');

    viewerWrappers.forEach(function(wrapper) {
        // Prevent clicks on the wrapper from bubbling to parent forms
        wrapper.addEventListener('click', function(event) {
            // Stop propagation to prevent form submission
            event.stopPropagation();
        });

        // Prevent mousedown events from bubbling
        wrapper.addEventListener('mousedown', function(event) {
            event.stopPropagation();
        });

        // Prevent touch events from bubbling (for mobile)
        wrapper.addEventListener('touchstart', function(event) {
            event.stopPropagation();
        }, { passive: true });

        // Find all buttons inside the wrapper
        const buttons = wrapper.querySelectorAll('button, .ar-button, .control-button');
        buttons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
            });
        });

        // Find all model-viewer elements and prevent their interactions from submitting forms
        const modelViewers = wrapper.querySelectorAll('model-viewer');
        modelViewers.forEach(function(viewer) {
            // Prevent all interaction events from bubbling
            ['click', 'mousedown', 'mouseup', 'touchstart', 'touchend'].forEach(function(eventType) {
                viewer.addEventListener(eventType, function(event) {
                    event.stopPropagation();
                }, { passive: true });
            });
        });
    });

    // Also handle AR button specifically
    const arButtons = document.querySelectorAll('.ar-button');
    arButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            // AR functionality will still work because model-viewer handles it internally
        });
    });

    console.log('3D Viewer: Form submission prevention initialized');
}

/**
 * Add analytics tracking for 3D viewer interactions (optional)
 */
function track3DInteraction(eventName, modelName) {
    // You can integrate with Google Analytics or other analytics platforms
    if (typeof gtag !== 'undefined') {
        gtag('event', eventName, {
            'event_category': '3D Viewer',
            'event_label': modelName
        });
    }

    console.log('3D Interaction:', eventName, modelName);
}

/**
 * Export for use in other scripts if needed
 */
window.Product3DViewer = {
    init: initModelViewers,
    initControls: initSingleProductControls,
    showError: showErrorMessage,
    trackInteraction: track3DInteraction,
    preventFormSubmission: preventFormSubmission
};
