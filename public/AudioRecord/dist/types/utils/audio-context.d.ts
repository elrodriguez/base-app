declare global {
    interface Window {
        webkitAudioContext: typeof AudioContext;
    }
}
export declare const AudioContext: {
    getAudioContext(): AudioContext;
    startAnalyze(stream: MediaStream): void;
    pauseAnalyze(): void;
    resumeAnalyze(): void;
    getAnalyser(): AnalyserNode;
    resetAnalyser(): void;
};
