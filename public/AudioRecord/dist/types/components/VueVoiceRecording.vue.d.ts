import { PropType } from 'vue';
import { AudioVisualizationType, AudioVisualizationOptions } from '../utils';
export interface RecorderEvents {
    afterStartRecording: () => void;
    afterStopRecording: (data: Blob) => void;
    afterPauseRecording: () => void;
    afterResumeRecording: () => void;
    getAsMp3(): (data: Blob) => void;
}
declare const _default: import("vue").DefineComponent<{
    showVisualization: {
        type: PropType<boolean>;
        default: boolean;
    };
    visualizationType: {
        type: PropType<AudioVisualizationType>;
        default: string;
    };
    visualizationOptions: {
        type: PropType<Omit<AudioVisualizationOptions, "canvas">>;
        default: {};
    };
}, () => void, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, ("afterStartRecording" | "afterStopRecording" | "afterPauseRecording" | "afterResumeRecording" | "getAsMp3")[], "afterStartRecording" | "afterStopRecording" | "afterPauseRecording" | "afterResumeRecording" | "getAsMp3", import("vue").VNodeProps & import("vue").AllowedComponentProps & import("vue").ComponentCustomProps, Readonly<import("vue").ExtractPropTypes<{
    showVisualization: {
        type: PropType<boolean>;
        default: boolean;
    };
    visualizationType: {
        type: PropType<AudioVisualizationType>;
        default: string;
    };
    visualizationOptions: {
        type: PropType<Omit<AudioVisualizationOptions, "canvas">>;
        default: {};
    };
}>> & {
    onAfterStartRecording?: ((...args: any[]) => any) | undefined;
    onAfterStopRecording?: ((...args: any[]) => any) | undefined;
    onAfterPauseRecording?: ((...args: any[]) => any) | undefined;
    onAfterResumeRecording?: ((...args: any[]) => any) | undefined;
    onGetAsMp3?: ((...args: any[]) => any) | undefined;
}, {
    showVisualization: boolean;
    visualizationType: AudioVisualizationType;
    visualizationOptions: Omit<AudioVisualizationOptions, "canvas">;
}>;
export default _default;
