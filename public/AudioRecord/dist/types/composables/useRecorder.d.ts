import { Ref } from 'vue';
export interface RecorderControls {
    startRecording: () => void;
    stopRecording: () => void;
    pauseRecording: () => void;
    resumeRecording: () => void;
    togglePauseAndResume: () => void;
    toggleStartAndStop: () => void;
    recordingBlob?: Ref<Blob | undefined>;
    isRecording: Ref<boolean>;
    isPaused: Ref<boolean>;
    recordingTime: Ref<string>;
    recordingState: Ref<RecordingState>;
}
export interface RecorderEvents {
    afterStartRecording: () => void;
    afterStopRecording: (data: Blob) => void;
    afterPauseRecording: () => void;
    afterResumeRecording: () => void;
    getAsMp3: (value: {
        data: Blob;
        url: string;
    }) => void;
}
export declare const useRecorder: (options?: Partial<RecorderEvents>) => RecorderControls;
