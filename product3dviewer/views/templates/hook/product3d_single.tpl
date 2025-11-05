{*
* Product 3D Viewer - Single Product Page
*
* @author    Claude AI
* @copyright 2025
* @license   AFL - Academic Free License (AFL 3.0)
*}

<div class="product3d-single-viewer">
    <div class="product3d-viewer-wrapper">
        <model-viewer
            src="{$module_dir}models/product.glb"
            alt="3D Product Model"
            {if $auto_rotate}auto-rotate{/if}
            {if $camera_controls}camera-controls{/if}
            shadow-intensity="1"
            environment-image="neutral"
            exposure="1"
            shadow-softness="1"
            camera-orbit="45deg 55deg 2.5m"
            min-camera-orbit="auto auto 1m"
            max-camera-orbit="auto auto 5m"
            loading="lazy"
            class="product3d-model-single">

            <div class="progress-bar" slot="progress-bar">
                <div class="update-bar"></div>
            </div>

            <button class="ar-button" slot="ar-button">
                View in AR
            </button>

            <div class="viewer-controls" slot="viewer-controls">
                <button class="control-button" id="rotate-toggle">
                    <i class="material-icons">360</i>
                </button>
                <button class="control-button" id="reset-camera">
                    <i class="material-icons">center_focus_strong</i>
                </button>
            </div>
        </model-viewer>
    </div>

    <div class="product3d-help">
        <div class="help-item">
            <i class="material-icons">touch_app</i>
            <span>Drag to rotate</span>
        </div>
        <div class="help-item">
            <i class="material-icons">zoom_in</i>
            <span>Scroll to zoom</span>
        </div>
        <div class="help-item">
            <i class="material-icons">pan_tool</i>
            <span>Right-click to pan</span>
        </div>
    </div>
</div>
